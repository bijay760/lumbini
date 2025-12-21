<?php

namespace App\Http\Controllers\Admin\LandParcel;

use App\Http\Controllers\Controller;
use App\Models\LandParcel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandParcelController extends Controller
{
    public function index(Request $request)
    {
        $landParcels = LandParcel::query()
            ->select('land_parcels.*')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%')
                        ->orWhere('location', 'like', '%' . $request->search . '%')
                        ->orWhere('municipality', 'like', '%' . $request->search . '%')
                        ->orWhere('ward_no', 'like', '%' . $request->search . '%')
                        ->orWhere('registration_number', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->land_type, function ($query) use ($request) {
                $query->where('land_type', $request->land_type);
            })
            ->when(!is_null($request->is_approved), function ($query) use ($request) {
                $query->where('is_approved', $request->is_approved);
            })
            ->orderBy('land_parcels.created_at', 'desc')
            ->paginate(10);


        $totalDhoor = $landParcels->sum('dhoor');
        $totalSqMeter = $landParcels->sum('total_area');
        $totalThaliAmount = $landParcels->sum('thali_amount');
        $total_available = $landParcels->sum('available_area');

        $landTypes = LandParcel::distinct()->pluck('land_type');

        return view('admin.properties.index', compact('total_available', 'totalDhoor', 'totalSqMeter', 'totalThaliAmount', 'landParcels', 'landTypes'));
    }

    public function view($id)
    {
        $landParcel = LandParcel::findOrFail($id);

        // Get payment documents (expenses) for land parcel
        $landParcelExpenses = DB::table('payment_documents')
            ->where('type', 'landParcel')
            ->where('type_id', $id)
            ->get();

        // Add plot title info to land parcel expenses
        foreach ($landParcelExpenses as $expense) {
            $expense->plot_title = null;
        }

        // Get plots for this land parcel
        $plots = DB::table('plots')
            ->where('land_parcel_id', $id)
            ->orderBy('plot_number')
            ->get();

        // Get expenses for each plot and add plot info
        $plotExpenses = collect();
        foreach ($plots as $plot) {
            $expenses = DB::table('payment_documents')
                ->where('type', 'plot')
                ->where('type_id', $plot->id)
                ->get();

            foreach ($expenses as $expense) {
                $expense->plot_title = $plot->title . ' (' . $plot->plot_number . ')';
            }

            $plotExpenses = $plotExpenses->merge($expenses);
        }

        // Get plot sales (revenue/credit entries)
        $plotSales = collect();
        foreach ($plots as $plot) {
            $sale = DB::table('plot_sales')
                ->where('plot_id', $plot->id)
                ->first();

            if ($sale) {
                $sale->plot_title = $plot->title . ' (' . $plot->plot_number . ')';
                // Attach sale-related expenses to the sale object
                $saleExpenses = DB::table('payment_documents')
                    ->where('type', 'sale')
                    ->where('type_id', $sale->id)
                    ->orderBy('date', 'desc')
                    ->get();
                $sale->sale_expenses = $saleExpenses;

                $plotSales->push($sale);
            }
        }

        // Combine all expenses and sort by date
        $allExpenses = $landParcelExpenses->merge($plotExpenses)->sortByDesc('date');

        // Calculate total expenses including purchase price and thali amount
        $totalExpenses = $allExpenses->sum('amount') + $landParcel->purchase_price + ($landParcel->thali_amount ?? 0);

        // Calculate total sales (revenue)
        $totalSales = $plotSales->sum('sale_price');

        // Get legal documents
        $legalDocuments = DB::table('legal_documents')
            ->where('type', 'landParcel')
            ->where('type_id', $id)
            ->get();

        return view('admin.properties.view', compact('landParcel', 'allExpenses', 'totalExpenses', 'legalDocuments', 'plotSales', 'totalSales'));
    }

    public function plotting($id)
    {
        $landParcel = LandParcel::findOrFail($id);

        // Get existing plots if any
        $existingPlots = DB::table('plots')
            ->where('land_parcel_id', $id)
            ->get();

        // Get expenses and legal documents for each plot
        foreach ($existingPlots as $plot) {
            $plot->expenses = DB::table('payment_documents')
                ->where('type', 'plot')
                ->where('type_id', $plot->id)
                ->get();

            $plot->legal_documents = DB::table('legal_documents')
                ->where('type', 'plot')
                ->where('type_id', $plot->id)
                ->get();
        }

        // Calculate deductions from existing data
        $totalPlotsArea = $existingPlots->sum('area');
        $roadArea = 0;
        $otherDeductions = 0;

        if ($landParcel->area_used > 0 && $totalPlotsArea > 0) {
            // Calculate deductions: area_used = totalPlotsArea + roadArea + otherDeductions
            $calculatedDeductions = $landParcel->area_used - $totalPlotsArea;
            // For simplicity, treat all deductions as "other_deductions" initially
            // User can adjust manually
            $otherDeductions = $calculatedDeductions > 0 ? $calculatedDeductions : 0;
        }

        return view('admin.properties.plotting', compact('landParcel', 'existingPlots', 'roadArea', 'otherDeductions'));
    }

    public function plottingStore(Request $request, $id)
    {
        $landParcel = LandParcel::findOrFail($id);

        // Validate the request
        $request->validate([
            'road_area' => 'nullable|numeric|min:0',
            'other_deductions' => 'nullable|numeric|min:0',
            'plots' => 'required|array|min:1',
            'plots.*.plot_number' => 'required|string',
            'plots.*.area' => 'required|numeric|min:0',
            'plots.*.price_per_unit' => 'nullable|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Save plots
            foreach ($request->plots as $plotIndex => $plotData) {
                $plotDataForSave = [
                    'land_parcel_id' => $id,
                    'title' => $plotData['title'] ?? 'Plot ' . $plotData['plot_number'],
                    'plot_number' => $plotData['plot_number'],
                    'area' => $plotData['area'],
                    'dimensions' => $plotData['dimensions'] ?? null,
                    'facing_direction' => $plotData['facing_direction'] ?? null,
                    'price_per_unit' => $plotData['price_per_unit'] ?? 0,
                    'total_price' => ($plotData['area'] * ($plotData['price_per_unit'] ?? 0)),
                    'features' => $plotData['features'] ?? null,
                    'remarks' => $plotData['remarks'] ?? null,
                    'status' => $plotData['status'] ?? 'available',
                    'updated_at' => now(),
                ];

                // Check if this is an existing plot (update) or new plot (insert)
                if (isset($plotData['id']) && !empty($plotData['id'])) {
                    // Update existing plot
                    DB::table('plots')->where('id', $plotData['id'])->update($plotDataForSave);
                    $plot = $plotData['id'];
                } else {
                    // Insert new plot
                    $plotDataForSave['created_at'] = now();
                    $plot = DB::table('plots')->insertGetId($plotDataForSave);
                }

                // Save plot expenses if provided
                if (isset($plotData['expenses'])) {
                    foreach ($plotData['expenses'] as $expIndex => $expense) {
                        if (!empty($expense['date'])) {
                            $expenseData = [
                                'date' => $expense['date'],
                                'type' => 'plot',
                                'type_id' => $plot,
                                'amount' => $expense['amount'] ?? 0,
                                'subject' => $expense['subject'] ?? '',
                                'remarks' => $expense['remarks'] ?? null,
                                'created_at' => now(),
                            ];

                            if ($request->hasFile("plots.$plotIndex.expenses.$expIndex.document")) {
                                $file = $request->file("plots.$plotIndex.expenses.$expIndex.document");
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

                // Save plot legal documents if provided
                if (isset($plotData['legal_documents'])) {
                    foreach ($plotData['legal_documents'] as $docIndex => $document) {
                        if (!empty($document['type'])) {
                            $docData = [
                                'title' => $document['type'],
                                'type' => 'plot',
                                'type_id' => $plot,
                                'description' => $document['description'] ?? null,
                                'created_at' => now(),
                            ];

                            if ($request->hasFile("plots.$plotIndex.legal_documents.$docIndex.document")) {
                                $file = $request->file("plots.$plotIndex.legal_documents.$docIndex.document");
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
            }

            // Update land parcel area used
            $totalPlotArea = collect($request->plots)->sum('area');
            $roadArea = $request->road_area ?? 0;
            $otherDeductions = $request->other_deductions ?? 0;

            DB::table('land_parcels')
                ->where('id', $id)
                ->update([
                    'area_used' => $totalPlotArea + $roadArea + $otherDeductions,
                    'available_area' => $landParcel->total_area - ($totalPlotArea + $roadArea + $otherDeductions),
                    'is_subdivided' => true,
                    'total_plots' => count($request->plots),
                    'updated_at' => now(),
                ]);

            DB::commit();

            return redirect()->route('admin.properties')->with('success', 'Plotting completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // Validate advertisement fields only if post_advertisement is checked
        if (!empty($data['post_advertisement'])) {
            $request->validate([
                'ad_property_type' => 'required|string',
                'ad_status' => 'required|in:pending,approved,rejected',
                'ad_title' => 'required|string|max:255',
                'ad_description' => 'required|string',
                'ad_location' => 'required|string',
                'ad_address' => 'required|string',
                'ad_city' => 'required|string',
                'ad_state' => 'required|string',
                'ad_zip_code' => 'required|string',
                'ad_country' => 'required|string',
                'ad_latitude' => 'nullable|regex:/^-?\d{1,2}\.\d{4,8}$/',
                'ad_longitude' => 'nullable|regex:/^-?\d{1,3}\.\d{4,8}$/',
                'ad_owner_name' => 'required|string|max:255',
                'ad_owner_email' => 'required|email',
                'ad_owner_phone' => 'required|string|max:20',
            ]);
        }
        $data['available_area'] = $data['total_area'];
        $data['is_parent'] = 1;
        $data['parent_id'] = null;
        $landParcel = LandParcel::create($data);
        if ($landParcel) {
            if ($request->expenses) {
                $expenses = $request->expenses;
                foreach ($expenses as $index => $expense) {
                    if (!empty($expense['date'])) {
                        $data = [
                            'date' => $expense['date'],
                            'type' => 'landParcel',
                            'type_id' => $landParcel->id,
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
                            'type_id' => $landParcel->id,
                            'type' => 'landParcel',
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
                        DB::table('legal_documents')->insert($data);
                    }
                }
            }
        }
        if (!empty($data['post_advertisement'])) {
            $property = new Property();
            $property->property_type = $request->ad_property_type;
            $property->status = $request->ad_status;
            $property->title = $request->ad_title;
            $property->description = $request->ad_description;
            $property->location = $request->ad_location;
            $property->address = $request->ad_address;
            $property->city = $request->ad_city;
            $property->state = $request->ad_state;
            $property->zip_code = $request->ad_zip_code;
            $property->country = $request->ad_country;
            $property->latitude = $request->ad_latitude;
            $property->longitude = $request->ad_longitude;
            $property->owner_name = $request->ad_owner_name;
            $property->owner_email = $request->ad_owner_email;
            $property->owner_phone = $request->ad_owner_phone;
            $property->ip_address = $request->ip();
            $property->save();

            // Handle Images if provided
            if ($request->hasFile('ad_property_images')) {
                $featuredImageId = null;

                foreach ($request->file('ad_property_images') as $index => $image) {
                    $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = base_path('backend/properties');

                    // Create directory if not exists
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    // Move uploaded file
                    $image->move($destinationPath, $filename);

                    // Build relative path
                    $relativePath = 'backend/properties/' . $filename;

                    // Create image record
                    $imageRecord = PropertyImage::create([
                        'property_id' => $property->id,
                        'path' => $relativePath,
                        'caption' => null,
                        'is_featured' => false,
                        'order' => $index,
                    ]);
                }
            }
        }

        return redirect()->route('admin.properties')
            ->with('success', 'Land parcel created successfully.');
    }

    public function delete($id)
    {
        DB::table('land_parcels')->where('id', $id)->delete();
        DB::table('land_parcels_documents')->where('land_parcels_id', $id)->delete();
        return redirect()->route('admin.properties')->with('success', 'Property Deleted Successfully');
    }

    public function edit($id)
    {
        $landParcel = LandParcel::find($id);
        $expenses = DB::table('payment_documents')->where('type', '=', 'landParcel')->where('type_id', $id)->get();
        $legal_documents = DB::table('legal_documents')->where('type', '=', 'landParcel')->where('type_id', $id)->get();
        return view('admin.properties.edit', compact('landParcel', 'expenses', 'legal_documents'));
    }

    public function deleteDocument($id)
    {
        DB::table('land_parcels_documents')->where('land_parcels_id', $id)->delete();
        return [
            'success' => true,
        ];
    }

    public function update(Request $request, $id)
    {
        $landParcel = LandParcel::findOrFail($id);
        $landParcel->update($request->all());
        if ($request->expenses) {
            $existingExpenseIds = [];
            $expenses = $request->expenses;

            foreach ($expenses as $index => $expense) {
                if (!empty($expense['date'])) {
                    $expenseData = [
                        'date' => $expense['date'],
                        'type' => 'landParcel',
                        'type_id' => $landParcel->id,
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
                        $last_insert_id = DB::table('payment_documents')->insertGetId($expenseData);
                        $existingExpenseIds[] = $last_insert_id;
                    }
                }
            }

            // Delete expenses that were removed
            if (!empty($existingExpenseIds)) {
                $expensesToDelete = DB::table('payment_documents')
                    ->where('type', 'landParcel')
                    ->where('type_id', $landParcel->id)
                    ->whereNotIn('id', $existingExpenseIds)
                    ->get();

                foreach ($expensesToDelete as $expense) {
                    if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                        unlink(base_path($expense->file_path));
                    }
                }

                DB::table('payment_documents')
                    ->where('type', 'landParcel')
                    ->where('type_id', $landParcel->id)
                    ->whereNotIn('id', $existingExpenseIds)
                    ->delete();
            }
        } else {
            // If no expenses in request, delete all existing expenses
            $expensesToDelete = DB::table('payment_documents')
                ->where('type', 'landParcel')
                ->where('type_id', $landParcel->id)
                ->get();

            foreach ($expensesToDelete as $expense) {
                if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                    unlink(base_path($expense->file_path));
                }
            }

            DB::table('payment_documents')
                ->where('type', 'landParcel')
                ->where('type_id', $landParcel->id)
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
                        'type_id' => $landParcel->id,
                        'type' => 'landParcel',
                        'description' => $document['description'],
                        'updated_at' => now(),
                    ];

                    // Check if this is an existing document (has ID)
                    if (!empty($document['id'])) {
                        $existingDocumentIds[] = $document['id'];
                        $docRecord = DB::table('legal_documents')->where('id', $document['id'])->first();

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
                        DB::table('legal_documents')
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

                        $last_insert_id = DB::table('legal_documents')->insertGetId($documentData);
                        $existingDocumentIds[] = $last_insert_id;
                    }
                }
            }

            // Delete documents that were removed
            if (!empty($existingDocumentIds)) {
                $docsToDelete = DB::table('legal_documents')
                    ->where('type_id', $landParcel->id)
                    ->whereNotIn('id', $existingDocumentIds)
                    ->get();

                foreach ($docsToDelete as $doc) {
                    if ($doc->file_path && file_exists(base_path($doc->file_path))) {
                        unlink(base_path($doc->file_path));
                    }
                }

                DB::table('legal_documents')
                    ->where('type_id', $landParcel->id)
                    ->whereNotIn('id', $existingDocumentIds)
                    ->delete();
            }
        } else {
            // If no legal documents in request, delete all existing documents
            $docsToDelete = DB::table('legal_documents')
                ->where('type_id', $landParcel->id)
                ->get();

            foreach ($docsToDelete as $doc) {
                if ($doc->file_path && file_exists(base_path($doc->file_path))) {
                    unlink(base_path($doc->file_path));
                }
            }

            DB::table('legal_documents')
                ->where('type_id', $landParcel->id)
                ->delete();
        }

        return redirect()->route('admin.properties')
            ->with('success', 'Land parcel updated successfully.');
    }

    public function merge()
    {
        $landParcels = LandParcel::query()
            ->select('land_parcels.*')
            ->orderBy('land_parcels.created_at', 'desc')->get()->toArray();
        return view('admin.properties.merge', compact('landParcels'));
    }

    public function mergeStore(Request $request)
    {
        $data = $request->all();
        if (isset($data['merging_properties'])) {
            $data['available_area'] = $data['total_area'];
            $data['is_parent'] = 1;
            $data['has_child'] = 1;
            $data['parent_id'] = null;
            $landParcel = LandParcel::create($data);

            foreach ($data['merging_properties'] as $mergingProperty) {
                // Get the property data
                $property = DB::table('land_parcels')
                    ->where('id', $mergingProperty)
                    ->first();

                if ($property) {
                    $subLandParcelColumns = Schema::getColumnListing('sub_land_parcels');
                    $propertyArray = collect((array)$property)
                        ->only($subLandParcelColumns)
                        ->toArray();
                    $propertyArray['land_parcel_id'] = $landParcel->id;
                    DB::table('sub_land_parcels')->insert($propertyArray);
                    DB::table('land_parcels')->where('id', $mergingProperty)->delete();
                }
            }
            if ($landParcel) {
                if ($request->expenses) {
                    $expenses = $request->expenses;
                    foreach ($expenses as $index => $expense) {
                        if (!empty($expense['date'])) {
                            $data = [
                                'date' => $expense['date'],
                                'type' => 'landParcel',
                                'type_id' => $landParcel->id,
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
                                'type_id' => $landParcel->id,
                                'type' => 'landParcel',
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
                            DB::table('legal_documents')->insert($data);
                        }
                    }
                }
            }
            return redirect()->route('admin.properties')
                ->with('success', 'Land parcel Merged successfully.');
        }
    }

    public function child_properties($id)
    {
        $landParcels = DB::table('sub_land_parcels')
            ->select('sub_land_parcels.*')
            ->where('land_parcel_id', $id)
            ->orderBy('sub_land_parcels.created_at', 'desc')
            ->paginate(10);

        $totalDhoor = $landParcels->sum('dhoor');
        $totalSqMeter = $landParcels->sum('total_area');
        $totalThaliAmount = $landParcels->sum('thali_amount');
        $total_available = $landParcels->sum('available_area');

        $landTypes = DB::table('sub_land_parcels')->distinct()->pluck('land_type');
        return view('admin.properties.sub_parcel', compact('total_available', 'totalDhoor', 'totalSqMeter', 'totalThaliAmount', 'landParcels', 'landTypes'));
    }

    public function sub_edit($id)
    {
        $landParcel = DB::table('sub_land_parcels')->where('id', $id)->first();
        $expenses = DB::table('payment_documents')->where('type', '=', 'landParcel')->where('type_id', $id)->get();
        $legal_documents = DB::table('legal_documents')->where('type', '=', 'landParcel')->where('type_id', $id)->get();
        return view('admin.properties.sub_edit', compact('landParcel', 'expenses', 'legal_documents'));
    }

    public function sub_update(Request $request, $id)
    { {
            $old_sub_land_parcel = DB::table('sub_land_parcels')->where('id', $id)->first();
            $data = $request->all();
            $tableColumns = Schema::getColumnListing('sub_land_parcels');
            $filteredData = array_intersect_key($data, array_flip($tableColumns));
            DB::table('sub_land_parcels')
                ->where('id', $id)
                ->update($filteredData);
            $new_sub_land_parcel = DB::table('sub_land_parcels')->where('id', $id)->first();
            if ($new_sub_land_parcel->total_area != $old_sub_land_parcel->total_area) {
                $areaDifference = $new_sub_land_parcel->total_area - $old_sub_land_parcel->total_area;
                DB::table('land_parcels')
                    ->where('id', $old_sub_land_parcel->land_parcel_id)
                    ->update([
                        'total_area' => DB::raw("total_area + {$areaDifference}"),
                        'updated_at' => now()
                    ]);
            }
            if ($new_sub_land_parcel->dhoor != $old_sub_land_parcel->dhoor) {
                $areaDifference = $new_sub_land_parcel->dhoor - $old_sub_land_parcel->dhoor;
                DB::table('land_parcels')
                    ->where('id', $old_sub_land_parcel->land_parcel_id)
                    ->update([
                        'dhoor' => DB::raw("dhoor + {$areaDifference}"),
                        'updated_at' => now()
                    ]);
            }
            if ($new_sub_land_parcel->thali_amount != $old_sub_land_parcel->thali_amount) {
                $areaDifference = $new_sub_land_parcel->thali_amount - $old_sub_land_parcel->thali_amount;
                DB::table('land_parcels')
                    ->where('id', $old_sub_land_parcel->land_parcel_id)
                    ->update([
                        'thali_amount' => DB::raw("thali_amount + {$areaDifference}"),
                        'updated_at' => now()
                    ]);
            }
            if ($request->expenses) {
                $existingExpenseIds = [];
                $expenses = $request->expenses;

                foreach ($expenses as $index => $expense) {
                    if (!empty($expense['date'])) {
                        $expenseData = [
                            'date' => $expense['date'],
                            'type' => 'landParcel',
                            'type_id' => $id,
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
                            $last_insert_id = DB::table('payment_documents')->insertGetId($expenseData);
                            $existingExpenseIds[] = $last_insert_id;
                        }
                    }
                }

                // Delete expenses that were removed
                if (!empty($existingExpenseIds)) {
                    $expensesToDelete = DB::table('payment_documents')
                        ->where('type', 'landParcel')
                        ->where('type_id', $id)
                        ->whereNotIn('id', $existingExpenseIds)
                        ->get();

                    foreach ($expensesToDelete as $expense) {
                        if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                            unlink(base_path($expense->file_path));
                        }
                    }

                    DB::table('payment_documents')
                        ->where('type', 'landParcel')
                        ->where('type_id', $id)
                        ->whereNotIn('id', $existingExpenseIds)
                        ->delete();
                }
            } else {
                // If no expenses in request, delete all existing expenses
                $expensesToDelete = DB::table('payment_documents')
                    ->where('type', 'landParcel')
                    ->where('type_id', $id)
                    ->get();

                foreach ($expensesToDelete as $expense) {
                    if ($expense->file_path && file_exists(base_path($expense->file_path))) {
                        unlink(base_path($expense->file_path));
                    }
                }

                DB::table('payment_documents')
                    ->where('type', 'landParcel')
                    ->where('type_id', $id)
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
                            'type_id' => $id,
                            'type' => 'landParcel',
                            'description' => $document['description'],
                            'updated_at' => now(),
                        ];

                        // Check if this is an existing document (has ID)
                        if (!empty($document['id'])) {
                            $existingDocumentIds[] = $document['id'];
                            $docRecord = DB::table('legal_documents')->where('id', $document['id'])->first();

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
                            DB::table('legal_documents')
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

                            $last_insert_id = DB::table('legal_documents')->insertGetId($documentData);
                            $existingDocumentIds[] = $last_insert_id;
                        }
                    }
                }

                // Delete documents that were removed
                if (!empty($existingDocumentIds)) {
                    $docsToDelete = DB::table('legal_documents')
                        ->where('type_id', $id)
                        ->whereNotIn('id', $existingDocumentIds)
                        ->get();

                    foreach ($docsToDelete as $doc) {
                        if ($doc->file_path && file_exists(base_path($doc->file_path))) {
                            unlink(base_path($doc->file_path));
                        }
                    }

                    DB::table('legal_documents')
                        ->where('type_id', $id)
                        ->whereNotIn('id', $existingDocumentIds)
                        ->delete();
                }
            } else {
                // If no legal documents in request, delete all existing documents
                $docsToDelete = DB::table('legal_documents')
                    ->where('type_id', $id)
                    ->get();

                foreach ($docsToDelete as $doc) {
                    if ($doc->file_path && file_exists(base_path($doc->file_path))) {
                        unlink(base_path($doc->file_path));
                    }
                }

                DB::table('legal_documents')
                    ->where('type_id', $id)
                    ->delete();
            }

            return redirect()->back()
                ->with('success', 'Land parcel updated successfully.');
        }
    }
}
