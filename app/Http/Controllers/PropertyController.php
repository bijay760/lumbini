<?php
// app/Http/Controllers/PropertyController.php
namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\PropertyImage;
//use App\Mail\PropertyRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Basic Information
            'property_type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',

            // Location
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'latitude' => 'nullable|regex:/^-?\d{1,3}\.\d{6,8}$/',
            'longitude' => 'nullable|regex:/^-?\d{1,3}\.\d{6,8}$/',

            // Specifications
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'area' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . now()->year,

            // Owner info
            'owner_name' => 'required|string|max:255',
            'owner_email' => 'required|email',
            'owner_phone' => 'required|string|max:20',
            'preferred_contact' => 'nullable|string|in:email,phone,both',

            // Property images
            'property_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB per image
            'featured_image' => 'nullable|string',

            // Features
            'features' => 'nullable|array',
            'features.*' => 'string',

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

            // Update featured_image_id on the property
            if ($featuredImageId) {
                $property->featured_image_id = $featuredImageId;
                $property->save();
            }
        }

        return redirect()->back()->with('success', 'Property registered successfully!');
    }
}
