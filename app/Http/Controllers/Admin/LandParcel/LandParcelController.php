<?php

namespace App\Http\Controllers\Admin\LandParcel;

use App\Http\Controllers\Controller;
use App\Models\LandParcel;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
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

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
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
    {
        {
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

