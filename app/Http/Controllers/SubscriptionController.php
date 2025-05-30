<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ], [
            'email.email' => 'Please enter a valid email address',
            'phone.max' => 'Phone number is too long',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Ensure at least one field is provided
        if (empty($request->email) && empty($request->phone)) {
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Please provide either email or phone number']
            ], 422);
        }

        try {
            Subscription::create([
                'email' => $request->email,
                'phone' => $request->phone,
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => ['general' => 'Subscription failed. Please try again later.']
            ], 500);
        }
    }
}
