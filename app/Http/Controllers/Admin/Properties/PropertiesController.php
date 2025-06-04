<?php

namespace App\Http\Controllers\Admin\Properties;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Jobs\SendEmailToUser;
use App\Mail\PropertyRegistered;
use App\Mail\PropertyRegisteredAdmin;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertiesController extends Controller
{
    public function index()
    {
        $properties = DB::table('properties')
            ->when(request('search'), function($query) {
                $query->where('title', 'like', '%'.request('search').'%')
                    ->orWhere('description', 'like', '%'.request('search').'%');
            })->orderBy('created_at', 'desc')
            ->paginate(10); // This returns a LengthAwarePaginator instance
        return view('admin.properties.index',compact('properties'));
    }

    public function delete($id){
        DB::table('properties')->where('id',$id)->delete();
        return redirect()->route('admin.properties')->with('success','Property Deleted Successfully');
    }
    public function edit($id){
        $property = DB::table('properties')->where('id', $id)->first();
        $images = DB::table('property_images')->where('property_id', $id)->get();
       return view('admin.properties.edit',compact('property','images'));
    }

    public function create(){
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Basic Information
            'property_type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'latitude' => 'nullable|regex:/^-?\d{1,3}\.\d{4,8}$/',
            'longitude' => 'nullable|regex:/^-?\d{1,3}\.\d{4,8}$/',

            // Owner info
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'owner_phone' => 'required|string|max:20',
            'preferred_contact' => 'nullable|string|in:email,phone,both',

            // Property images
            'property_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB per image
            'featured_image' => 'nullable|string',

            'additional_info' => 'nullable|string',
            'agree_terms' => 'required|accepted'
        ]);

        // Create Property
        $property = new Property();
        $property->fill($validated);
        $property->features = json_encode($request->features ?? []);
        $property->additional_info = $request->additional_info;
        $property->ip_address=$request->ip();
        $property->save();

        // Handle Images
        $uploadedImagePaths = [];

        if ($request->hasFile('property_images')) {
            $featuredImageId = null;

            foreach ($request->file('property_images') as $index => $image) {
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/properties');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Move uploaded file to backend/properties folder
                $image->move($destinationPath, $filename);

                // Build relative path to save in DB
                $relativePath = 'backend/properties/' . $filename;

                // Create image record in DB
                $imageRecord = PropertyImage::create([
                    'property_id' => $property->id,
                    'path' => $relativePath,
                    'caption' => null, // Optionally get from $request if needed
                    'is_featured' => ($filename === $request->featured_image),
                    'order' => $index,
                ]);

                // Capture featured image ID if this is the featured image
                if ($filename === $request->featured_image) {
                    $featuredImageId = $imageRecord->id;
                }

                $uploadedImagePaths[] = $imageRecord;
            }
            if ($featuredImageId) {
                $property->featured_image_id = $featuredImageId;
                $property->save();
            }
        }
        return redirect()->route('admin.properties')->with('success', 'Property registered successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            // Basic Information
            'property_type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'latitude' => 'nullable|regex:/^-?\d{1,3}\.\d{4,8}$/',
            'longitude' => 'nullable|regex:/^-?\d{1,3}\.\d{4,8}$/',

            // Owner info
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'owner_phone' => 'required|string|max:20',
            'preferred_contact' => 'nullable|string|in:email,phone,both',

            // Property images
            'property_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB per image
            'featured_image' => 'nullable|string',

            'additional_info' => 'nullable|string',
            // Removed agree_terms as it's not typically needed for updates
        ]);

        // Find and update Property
        $property = Property::findOrFail($id);
        $property->fill($validated);
        $property->features = json_encode($request->features ?? []);
        $property->additional_info = $request->additional_info;
        $property->save();

        // Handle New Images
        $uploadedImagePaths = [];
        $featuredImageId = $property->featured_image_id; // Keep existing featured image by default

        if ($request->hasFile('property_images')) {
            // Get the current highest order number
            $currentMaxOrder = PropertyImage::where('property_id', $property->id)->max('order') ?? 0;

            foreach ($request->file('property_images') as $index => $image) {
                $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('backend/properties');

                // Create directory if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Move uploaded file to backend/properties folder
                $image->move($destinationPath, $filename);

                // Build relative path to save in DB
                $relativePath = 'backend/properties/' . $filename;

                // Create image record in DB
                $imageRecord = PropertyImage::create([
                    'property_id' => $property->id,
                    'path' => $relativePath,
                    'caption' => null,
                    'is_featured' => ($filename === $request->featured_image),
                    'order' => $currentMaxOrder + $index + 1,
                ]);

                // Capture featured image ID if this is the featured image
                if ($filename === $request->featured_image) {
                    $featuredImageId = $imageRecord->id;
                }

                $uploadedImagePaths[] = $imageRecord;
            }

            // Update featured image if a new one was selected
            if ($featuredImageId !== $property->featured_image_id) {
                // First, unset any existing featured images
                PropertyImage::where('property_id', $property->id)
                    ->update(['is_featured' => false]);

                // Set the new featured image
                if ($featuredImageId) {
                    PropertyImage::where('id', $featuredImageId)
                        ->update(['is_featured' => true]);
                    $property->featured_image_id = $featuredImageId;
                    $property->save();
                }
            }
        }

        // Handle featured image selection from existing images
        if ($request->has('featured_image') && !$request->hasFile('property_images')) {
            // First, unset any existing featured images
            PropertyImage::where('property_id', $property->id)
                ->update(['is_featured' => false]);

            // Find the existing image that matches the featured_image path
            $featuredImage = PropertyImage::where('property_id', $property->id)
                ->where('path', 'like', '%' . $request->featured_image)
                ->first();

            if ($featuredImage) {
                $featuredImage->is_featured = true;
                $featuredImage->save();
                $property->featured_image_id = $featuredImage->id;
                $property->save();
            }
        }

        return redirect()->route('admin.properties')->with('success', 'Property updated successfully!');
    }

}
