<?php

namespace App\Http\Controllers\Admin\LandParcel;

use App\Http\Controllers\Controller;
use App\Models\LandParcel;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LandParcelController extends Controller
{
    // Index - List all land parcels
    public function index(Request $request)
    {
        $landParcels = LandParcel::withCount('plots')
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
            ->when($request->is_approved !== null, function ($query) use ($request) {
                $query->where('is_approved', $request->is_approved);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalDhoor = $landParcels->sum('dhoor');
        $totalSqMeter = $landParcels->sum('total_area');
        $totalThaliAmount = $landParcels->sum('thali_amount');

        $landTypes = LandParcel::distinct()->pluck('land_type');

        return view('admin.properties.index', compact('totalDhoor','totalSqMeter','totalThaliAmount','landParcels', 'landTypes'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $landParcel = LandParcel::create($request->all());
        if ($landParcel) {
            if ($request->hasFile('tax_files')) {
                $image = $request->file('tax_files');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('backend/properties');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $filename);
                $tax_file_path = 'backend/properties/' . $filename;
                DB::table('land_parcels_documents')->insert([
                    'type'=>'tax',
                        'image_name'=>$tax_file_path,
                        'land_parcels_id'=>$landParcel->id,
                    ]
                );
            }
            if ($request->hasFile('documents')) {
                $image = $request->file('documents');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('backend/properties');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $filename);
                $document_file_path = 'backend/properties/' . $filename;
                DB::table('land_parcels_documents')->insert([
                        'type'=>'purchase',
                        'image_name'=>$document_file_path,
                        'land_parcels_id'=>$landParcel->id,
                    ]
                );
            }
        }
        return redirect()->route('admin.properties')
            ->with('success', 'Land parcel created successfully.');
    }

    public function delete($id){
        DB::table('land_parcels')->where('id',$id)->delete();
        DB::table('land_parcels_documents')->where('land_parcels_id',$id)->delete();
        return redirect()->route('admin.properties')->with('success','Property Deleted Successfully');
    }

    public function edit($id)
    {
        $landParcel = LandParcel::find($id);
        $images=DB::table('land_parcels_documents')->where('land_parcels_id',$id)->get();
        return view('admin.properties.edit',compact('landParcel','images'));
    }

    public function deleteDocument($id){
        DB::table('land_parcels_documents')->where('land_parcels_id',$id)->delete();
        return [
            'success' => true,
        ];
    }

    public function update(Request $request, $id)
    {
        $landParcel = LandParcel::findOrFail($id);
        $landParcel->update($request->all());

        if ($landParcel) {
            if ($request->hasFile('tax_files')) {
                // Delete old tax file if exists
                $oldTaxFile = DB::table('land_parcels_documents')
                    ->where('land_parcels_id', $landParcel->id)
                    ->where('type', 'tax')
                    ->first();

                if ($oldTaxFile && file_exists(base_path($oldTaxFile->image_name))) {
                    unlink(base_path($oldTaxFile->image_name));
                }

                // Upload new tax file
                $image = $request->file('tax_files');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('backend/properties');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $filename);
                $tax_file_path = 'backend/properties/' . $filename;

                // Update or insert tax document record
                DB::table('land_parcels_documents')
                    ->updateOrInsert(
                        ['land_parcels_id' => $landParcel->id, 'type' => 'tax'],
                        ['image_name' => $tax_file_path]
                    );
            }

            if ($request->hasFile('documents')) {
                // Delete old document file if exists
                $oldDocFile = DB::table('land_parcels_documents')
                    ->where('land_parcels_id', $landParcel->id)
                    ->where('type', 'purchase')
                    ->first();

                if ($oldDocFile && file_exists(base_path($oldDocFile->image_name))) {
                    unlink(base_path($oldDocFile->image_name));
                }

                // Upload new document file
                $image = $request->file('documents');
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = base_path('backend/properties');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $filename);
                $document_file_path = 'backend/properties/' . $filename;

                // Update or insert purchase document record
                DB::table('land_parcels_documents')
                    ->updateOrInsert(
                        ['land_parcels_id' => $landParcel->id, 'type' => 'purchase'],
                        ['image_name' => $document_file_path]
                    );
            }
        }

        return redirect()->route('admin.properties')
            ->with('success', 'Land parcel updated successfully.');
    }
}

