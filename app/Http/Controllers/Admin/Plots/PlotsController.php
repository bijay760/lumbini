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
            ? Plot::with('landParcel')->where('land_parcel_id', $landParcelId)->orderBy('created_at','desc')->paginate(10)
            : Plot::with('landParcel')->orderBy('created_at','desc')->paginate(10);

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
        $expenses=DB::table('payment_documents')->where('type','=','plot')->where('type_id',$id)->get();
        $legal_documents=DB::table('plot_leagal_documents')->where('plot_id',$id)->get();
        return view('admin.plots.edit', compact('landParcels','plot','expenses','legal_documents'));
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
}
