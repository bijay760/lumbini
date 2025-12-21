<?php

namespace App\Http\Controllers\Admin\Plots;

use App\Http\Controllers\Controller;
use App\Models\LandParcel;
use App\Models\Plot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlotsController extends Controller
{
    public function index()
    {
        $landParcelId = request('id');

        $plots = $landParcelId
            ? Plot::with('landParcel')->where('land_parcel_id', $landParcelId)->orderBy('created_at', 'desc')->paginate(10)
            : Plot::with('landParcel')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.plots.index', compact('plots'));
    }


    public function create()
    {
        $landParcels = LandParcel::all();
        return view('admin.plots.create', compact('landParcels'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $plot = Plot::create($data);
        DB::table('land_parcels')
            ->where('id', $plot->land_parcel_id)
            ->decrement('available_area', $plot->area);

        if ($request->expenses) {
            $expenses = $request->expenses;
            foreach ($expenses as $index => $expense) {
                if (!empty($expense['date'])) {
                    $data = [
                        'date' => $expense['date'],
                        'type' => 'plot',
                        'type_id' => $plot->id,
                        'amount' => $expense['amount'],
                        'subject' => $expense['subject'],
                        'remarks' => $expense['remarks'],
                        'created_at' => now(),
                    ];

                    if ($request->hasFile("expenses.$index.document")) {
                        $file = $request->file("expenses.$index.document");
                        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = base_path('backend/properties');
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                        $file->move($destinationPath, $filename);
                        $relativePath = 'backend/properties/' . $filename;
                        $data['file_path'] = $relativePath;
                    }
                    DB::table('payment_documents')->insert($data);
                }
            }
        }

        if ($request->legal_documents) {
            $documents = $request->legal_documents;
            foreach ($documents as $index => $document) {
                if (!empty($document['type'])) {
                    $data = [
                        'title' => $document['type'],
                        'plot_id' => $plot->id,
                        'description' => $document['description'],
                        'created_at' => now(),
                    ];

                    if ($request->hasFile("legal_documents.$index.document")) {
                        $file = $request->file("legal_documents.$index.document");
                        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                        $destinationPath = base_path('backend/properties');
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                        $file->move($destinationPath, $filename);
                        $relativePath = 'backend/properties/' . $filename;
                        $data['file_path'] = $relativePath;
                    }
                    DB::table('plot_leagal_documents')->insert($data);
                }
            }
        }

        return redirect()->route('admin.plots')->with('success', 'Plots Created successfully!');
    }

    public function edit($id)
    {
        $landParcels = LandParcel::all();
        $plot = Plot::with('landParcel')->find($id);
        $expenses = DB::table('payment_documents')->where('type', '=', 'plot')->where('type_id', $id)->get();
        $legal_documents = DB::table('plot_leagal_documents')->where('plot_id', $id)->get();
        return view('admin.plots.edit', compact('landParcels', 'plot', 'expenses', 'legal_documents'));
    }

    public function update(Request $request, $id)
    {
        $plot = Plot::findOrFail($id);
        $originalArea = $plot->area;
        $data = $request->all();

        // Update the plot
        $plot->update($data);

        // Update available area in land parcel if area changed
        if ($originalArea != $plot->area) {
            DB::table('land_parcels')
                ->where('id', $plot->land_parcel_id)
                ->update([
                    'available_area' => DB::raw("available_area + {$originalArea} - {$plot->area}")
                ]);
        }
        // Handle expenses
        if ($request->expenses) {
            $existingExpenseIds = [];
            $expenses = $request->expenses;

            foreach ($expenses as $index => $expense) {
                if (!empty($expense['date'])) {
                    $expenseData = [
                        'date' => $expense['date'],
                        'type' => 'plot',
                        'type_id' => $plot->id,
                        'amount' => $expense['amount'],
                        'subject' => $expense['subject'],
                        'remarks' => $expense['remarks'],
                        'updated_at' => now(),
                    ];

                    // Check if this is an existing expense (has ID)
                    if (!empty($expense['id'])) {
                        $existingExpenseIds[] = $expense['id'];
                        $expenseRecord = DB::table('payment_documents')->where('id', $expense['id'])->first();

                        // Handle file upload if new file provided
                        if ($request->hasFile("expenses.$index.document")) {
                            // Delete old file if exists
                            if ($expenseRecord->file_path && file_exists(base_path($expenseRecord->file_path))) {
                                unlink(base_path($expenseRecord->file_path));
                            }

                            // Upload new file
                            $file = $request->file("expenses.$index.document");
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $destinationPath = base_path('backend/properties');
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }
                            $file->move($destinationPath, $filename);
                            $relativePath = 'backend/properties/' . $filename;
                            $expenseData['file_path'] = $relativePath;
                        }

                        // Update existing expense
                        DB::table('payment_documents')
                            ->where('id', $expense['id'])
                            ->update($expenseData);
                    } else {
                        // This is a new expense
                        $expenseData['created_at'] = now();

                        // Handle file upload for new expense
                        if ($request->hasFile("expenses.$index.document")) {
                            $file = $request->file("expenses.$index.document");
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $destinationPath = base_path('backend/properties');
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }
                            $file->move($destinationPath, $filename);
                            $relativePath = 'backend/properties/' . $filename;
                            $expenseData['file_path'] = $relativePath;
                        }

                        DB::table('payment_documents')->insert($expenseData);
                    }
                }
            }

            // Delete expenses that were removed
            if (!empty($existingExpenseIds)) {
                $expensesToDelete = DB::table('payment_documents')
                    ->where('type', 'plot')
                    ->where('type_id', $plot->id)
                    ->whereNotIn('id', $existingExpenseIds)
                    ->get();

                foreach ($expensesToDelete as $expense) {
                    if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                        unlink(base_path($expense->file_path));
                    }
                }

                DB::table('payment_documents')
                    ->where('type', 'plot')
                    ->where('type_id', $plot->id)
                    ->whereNotIn('id', $existingExpenseIds)
                    ->delete();
            }
        } else {
            // If no expenses in request, delete all existing expenses
            $expensesToDelete = DB::table('payment_documents')
                ->where('type', 'plot')
                ->where('type_id', $plot->id)
                ->get();

            foreach ($expensesToDelete as $expense) {
                if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                    unlink(base_path($expense->file_path));
                }
            }

            DB::table('payment_documents')
                ->where('type', 'plot')
                ->where('type_id', $plot->id)
                ->delete();
        }

        // Handle legal documents
        if ($request->legal_documents) {
            $existingDocumentIds = [];
            $documents = $request->legal_documents;

            foreach ($documents as $index => $document) {
                if (!empty($document['type'])) {
                    $documentData = [
                        'title' => $document['type'],
                        'plot_id' => $plot->id,
                        'description' => $document['description'],
                        'updated_at' => now(),
                    ];

                    // Check if this is an existing document (has ID)
                    if (!empty($document['id'])) {
                        $existingDocumentIds[] = $document['id'];
                        $docRecord = DB::table('plot_leagal_documents')->where('id', $document['id'])->first();

                        // Handle file upload if new file provided
                        if ($request->hasFile("legal_documents.$index.document")) {
                            // Delete old file if exists
                            if ($docRecord->file_path && file_exists(base_path($docRecord->file_path))) {
                                unlink(base_path($docRecord->file_path));
                            }

                            // Upload new file
                            $file = $request->file("legal_documents.$index.document");
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $destinationPath = base_path('backend/properties');
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }
                            $file->move($destinationPath, $filename);
                            $relativePath = 'backend/properties/' . $filename;
                            $documentData['file_path'] = $relativePath;
                        }

                        // Update existing document
                        DB::table('plot_leagal_documents')
                            ->where('id', $document['id'])
                            ->update($documentData);
                    } else {
                        // This is a new document
                        $documentData['created_at'] = now();

                        // Handle file upload for new document
                        if ($request->hasFile("legal_documents.$index.document")) {
                            $file = $request->file("legal_documents.$index.document");
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $destinationPath = base_path('backend/properties');
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }
                            $file->move($destinationPath, $filename);
                            $relativePath = 'backend/properties/' . $filename;
                            $documentData['file_path'] = $relativePath;
                        }

                        DB::table('plot_leagal_documents')->insert($documentData);
                    }
                }
            }

            // Delete documents that were removed
            if (!empty($existingDocumentIds)) {
                $docsToDelete = DB::table('plot_leagal_documents')
                    ->where('plot_id', $plot->id)
                    ->whereNotIn('id', $existingDocumentIds)
                    ->get();

                foreach ($docsToDelete as $doc) {
                    if ($doc->file_path && file_exists(base_path($doc->file_path))) {
                        unlink(base_path($doc->file_path));
                    }
                }

                DB::table('plot_leagal_documents')
                    ->where('plot_id', $plot->id)
                    ->whereNotIn('id', $existingDocumentIds)
                    ->delete();
            }
        } else {
            // If no legal documents in request, delete all existing documents
            $docsToDelete = DB::table('plot_leagal_documents')
                ->where('plot_id', $plot->id)
                ->get();

            foreach ($docsToDelete as $doc) {
                if ($doc->file_path && file_exists(base_path($doc->file_path))) {
                    unlink(base_path($doc->file_path));
                }
            }

            DB::table('plot_leagal_documents')
                ->where('plot_id', $plot->id)
                ->delete();
        }

        return redirect()->route('admin.plots')->with('success', 'Plot updated successfully!');
    }
    public function destroy($id)
    {
        // Begin database transaction to ensure data consistency
        DB::beginTransaction();

        try {
            $plot = Plot::findOrFail($id);

            // 1. Get the land parcel to update available area
            $landParcel = DB::table('land_parcels')
                ->where('id', $plot->land_parcel_id)
                ->first();

            // 2. Delete all associated expenses and their files
            $expenses = DB::table('payment_documents')
                ->where('type', 'plot')
                ->where('type_id', $id)
                ->get();

            foreach ($expenses as $expense) {
                if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                    unlink(base_path($expense->file_path));
                }
            }

            DB::table('payment_documents')
                ->where('type', 'plot')
                ->where('type_id', $id)
                ->delete();

            // 3. Delete all legal documents and their files
            $legalDocuments = DB::table('plot_leagal_documents')
                ->where('plot_id', $id)
                ->get();

            foreach ($legalDocuments as $document) {
                if ($document->file_path && file_exists(base_path($document->file_path))) {
                    unlink(base_path($document->file_path));
                }
            }

            DB::table('plot_leagal_documents')
                ->where('plot_id', $id)
                ->delete();

            // 4. Return the plot area to the land parcel's available area
            DB::table('land_parcels')
                ->where('id', $plot->land_parcel_id)
                ->increment('available_area', $plot->area);

            // 5. Finally delete the plot itself
            $plot->delete();

            // Commit all changes
            DB::commit();

            return redirect()->route('admin.plots')->with('success', 'Plot deleted successfully!');
        } catch (\Exception $e) {
            // Rollback all changes if something goes wrong
            DB::rollBack();

            return redirect()->route('admin.plots')
                ->with('error', 'Error deleting plot: ' . $e->getMessage());
        }
    }

    public function viewSale($id)
    {
        $plot = Plot::with('landParcel')->findOrFail($id);
        // Try to get sale record if exists
        $sale = DB::table('plot_sales')->where('plot_id', $id)->first();

        // If no sale, create a placeholder stdClass with defaults to avoid undefined property errors in view
        if (!$sale) {
            $sale = new \stdClass();
            $sale->id = null;
            $sale->sale_number = '-';
            $sale->sale_date = null;
            $sale->sale_price = $plot->total_price ?? 0;
            $sale->paid_amount = 0;
            $sale->due_amount = 0;
            $sale->payment_type = 'n/a';
            $sale->installment_period = null;
            $sale->down_payment = 0;
            $sale->next_payment_date = null;
            $sale->payment_status = 'n/a';
            $sale->remarks = null;
            $sale->customer_id = null;
            $sale->customer_name = null;
            $sale->customer_phone = null;
            $sale->customer_email = null;
            $sale->customer_address = null;
        }

        // Get customer information if available
        $customer = null;
        if (!empty($sale->customer_id)) {
            $customer = DB::table('customers')->where('id', $sale->customer_id)->first();
        }

        // Payment history (empty if no sale)
        $payments = collect();
        if (!empty($sale->id)) {
            $payments = DB::table('plot_payments')
                ->where('plot_sale_id', $sale->id)
                ->orderBy('payment_date', 'desc')
                ->get();
        }

        // Sale expenses (empty if no sale)
        $expenses = collect();
        if (!empty($sale->id)) {
            $expenses = DB::table('payment_documents')
                ->where('type', 'sale')
                ->where('type_id', $sale->id)
                ->orderBy('date', 'desc')
                ->get();
        }

        // Legal documents (empty if no sale)
        $legalDocuments = collect();
        if (!empty($sale->id)) {
            $legalDocuments = DB::table('legal_documents')
                ->where('type', 'sale')
                ->where('type_id', $sale->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('admin.plots.view', compact('plot', 'sale', 'customer', 'payments', 'expenses', 'legalDocuments'));
    }

    public function sell($id)
    {
        $plot = Plot::with('landParcel')->findOrFail($id);

        if ($plot->status == 'sold') {
            return redirect()->route('admin.plots')->with('error', 'This plot is already sold!');
        }

        // Get all customers
        $customers = DB::table('customers')->orderBy('name')->get();

        return view('admin.plots.sell', compact('plot', 'customers'));
    }

    public function sellStore(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required',
            'customer_name' => 'required_if:customer_id,new|string|max:255',
            'customer_phone' => 'required_if:customer_id,new|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'customer_address' => 'nullable|string',
            'sale_date' => 'required|date',
            'sale_price' => 'required|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'payment_type' => 'required|in:full,installment',
        ]);

        try {
            DB::beginTransaction();

            $plot = Plot::findOrFail($id);

            // Handle customer creation if needed
            $customerId = $request->customer_id;
            if ($customerId === 'new') {
                $customerId = DB::table('customers')->insertGetId([
                    'name' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'email' => $request->customer_email,
                    'address' => $request->customer_address,
                    'citizenship_number' => $request->citizenship_number,
                    'pan_number' => $request->pan_number,
                    'customer_type' => 'individual',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Create sale record
            $saleData = [
                'plot_id' => $id,
                'customer_id' => $customerId,
                'sale_number' => 'SALE-' . strtoupper(Str::random(8)),
                'sale_date' => $request->sale_date,
                'sale_price' => $request->sale_price,
                'discount' => 0,
                'total_amount' => $request->sale_price,
                'paid_amount' => $request->paid_amount,
                'due_amount' => $request->sale_price - $request->paid_amount,
                'payment_type' => $request->payment_type,
                'installment_period' => $request->installment_period,
                'down_payment' => $request->down_payment,
                'payment_status' => ($request->sale_price == $request->paid_amount) ? 'paid' : 'partial',
                'sale_status' => 'completed',
                'remarks' => $request->remarks,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $saleId = DB::table('plot_sales')->insertGetId($saleData);

            // Save sale expenses if provided
            if ($request->expenses) {
                foreach ($request->expenses as $expIndex => $expense) {
                    if (!empty($expense['date'])) {
                        $expenseData = [
                            'date' => $expense['date'],
                            'type' => 'sale',
                            'type_id' => $saleId,
                            'amount' => $expense['amount'] ?? 0,
                            'subject' => $expense['subject'] ?? '',
                            'remarks' => $expense['remarks'] ?? null,
                            'created_at' => now(),
                        ];

                        if ($request->hasFile("expenses.$expIndex.document")) {
                            $file = $request->file("expenses.$expIndex.document");
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $destinationPath = base_path('backend/properties');
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }
                            $file->move($destinationPath, $filename);
                            $expenseData['file_path'] = 'backend/properties/' . $filename;
                        }

                        DB::table('payment_documents')->insert($expenseData);
                    }
                }
            }

            // Save legal documents if provided
            if ($request->legal_documents) {
                foreach ($request->legal_documents as $docIndex => $document) {
                    if (!empty($document['type'])) {
                        $docData = [
                            'title' => $document['type'],
                            'type' => 'sale',
                            'type_id' => $saleId,
                            'description' => $document['description'] ?? null,
                            'created_at' => now(),
                        ];

                        if ($request->hasFile("legal_documents.$docIndex.document")) {
                            $file = $request->file("legal_documents.$docIndex.document");
                            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                            $destinationPath = base_path('backend/properties');
                            if (!file_exists($destinationPath)) {
                                mkdir($destinationPath, 0777, true);
                            }
                            $file->move($destinationPath, $filename);
                            $docData['file_path'] = 'backend/properties/' . $filename;
                        }

                        DB::table('legal_documents')->insert($docData);
                    }
                }
            }

            // Update plot status to sold
            $plot->update(['status' => 'sold']);

            DB::commit();

            return redirect()->route('admin.plots')->with('success', 'Plot sold successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function payment($id)
    {
        $plot = Plot::with('landParcel')->findOrFail($id);

        if ($plot->status != 'sold') {
            return redirect()->route('admin.plots')->with('error', 'This plot is not sold yet!');
        }

        $sale = DB::table('plot_sales')->where('plot_id', $id)->first();

        if (!$sale) {
            return redirect()->route('admin.plots')->with('error', 'No sale record found for this plot!');
        }

        if ($sale->payment_status == 'paid') {
            return redirect()->route('admin.plots')->with('error', 'This plot is already fully paid!');
        }

        // Get payment history
        $payments = DB::table('plot_payments')
            ->where('plot_sale_id', $sale->id)
            ->orderBy('payment_date', 'desc')
            ->get();

        // Get customer name
        $customer = DB::table('customers')->where('id', $sale->customer_id)->first();
        $sale->customer_name = $customer ? $customer->name : 'N/A';

        return view('admin.plots.payment', compact('plot', 'sale', 'payments'));
    }

    public function paymentStore(Request $request, $id)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,bank_transfer,cheque,online',
            'transaction_reference' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'document' => 'nullable|file|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $plot = Plot::findOrFail($id);
            $sale = DB::table('plot_sales')->where('plot_id', $id)->first();

            if (!$sale) {
                return back()->with('error', 'No sale record found!')->withInput();
            }

            // Validate payment amount doesn't exceed due amount
            if ($request->amount > $sale->due_amount) {
                return back()->with('error', 'Payment amount cannot exceed due amount of Rs. ' . number_format($sale->due_amount, 2))->withInput();
            }

            // Handle document upload
            $documentPath = null;
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = base_path('backend/properties');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $file->move($destinationPath, $filename);
                $documentPath = 'backend/properties/' . $filename;
            }

            // Insert payment record
            DB::table('plot_payments')->insert([
                'plot_sale_id' => $sale->id,
                'payment_date' => $request->payment_date,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'transaction_reference' => $request->transaction_reference,
                'remarks' => $request->remarks,
                'document_path' => $documentPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Update sale record
            $newPaidAmount = $sale->paid_amount + $request->amount;
            $newDueAmount = $sale->due_amount - $request->amount;
            $newPaymentStatus = $newDueAmount <= 0 ? 'paid' : 'partial';

            DB::table('plot_sales')
                ->where('id', $sale->id)
                ->update([
                    'paid_amount' => $newPaidAmount,
                    'due_amount' => $newDueAmount,
                    'payment_status' => $newPaymentStatus,
                    'updated_at' => now(),
                ]);

            DB::commit();

            $message = $newPaymentStatus == 'paid'
                ? 'Payment added successfully! Plot is now fully paid.'
                : 'Payment added successfully! Remaining due: Rs. ' . number_format($newDueAmount, 2);

            return redirect()->route('admin.plots')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }
}
