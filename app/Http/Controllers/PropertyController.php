<?php
// app/Http/Controllers/PropertyController.php
namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
//use App\Mail\PropertyRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_type' => 'required|in:house,apartment,land,commercial',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . date('Y'),
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email|max:255',
            'owner_phone' => 'required|string|max:20',
            'preferred_contact' => 'nullable|in:email,phone,both',
            'additional_info' => 'nullable|string|max:1000',
            'agree_terms' => 'required|accepted',
            'features' => 'nullable|array',
            'features.*' => 'string|in:garage,garden,pool,fireplace'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

//        try {
            Property::create([
                'property_type' => $request->property_type,
                'title' => $request->title,
                'description' => $request->description,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'area' => $request->area,
                'price' => $request->price,
                'year_built' => $request->year_built,
                'features' => $request->features,
                'owner_name' => $request->owner_name,
                'owner_email' => $request->owner_email,
                'owner_phone' => $request->owner_phone,
                'preferred_contact' => $request->preferred_contact ?? 'email',
                'additional_info' => $request->additional_info,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'pending'
            ]);

            // Send confirmation email to property owner
//            Mail::to($property->owner_email)
//                ->send(new PropertyRegistered($property));
        return back()->with('message', 'Your property has been registered successfully! Our team will review it shortly.');



//        } catch (\Exception $e) {
//            \Log::error('Property registration failed: ' . $e->getMessage());
//
//            return response()->json([
//                'success' => false,
//                'message' => 'Failed to register property. Please try again later.'
//            ], 500);
//        }
    }
}
