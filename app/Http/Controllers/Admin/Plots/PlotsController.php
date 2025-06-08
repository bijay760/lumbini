<?php

namespace App\Http\Controllers\Admin\Plots;

use App\Http\Controllers\Controller;
use App\Models\LandParcel;
use App\Models\Plot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlotsController extends Controller
{
    public function index()
    {
        $landParcelId = request('id');
        $plots = $landParcelId
            ? Plot::where('land_parcel_id', $landParcelId)->paginate(10)
            : Plot::paginate(10);

        return view('admin.plots.index', compact('plots'));
    }
    public function create()
    {
        $landParcels = LandParcel::all();
        return view('admin.plots.create', compact('landParcels'));
    }
    public function store(Request $request){
        dd($request->all());
    }
}
