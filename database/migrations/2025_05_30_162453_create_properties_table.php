<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('property_type');
            $table->string('title');
            $table->text('description');

            // Location Details
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
            $table->decimal('latitude', 10, 8)->nullable();   // e.g. 27.717245
            $table->decimal('longitude', 11, 8)->nullable();  // e.g. 85.324036

            // Property Specifications
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area', 10, 2);
            $table->decimal('price', 12, 2);
            $table->integer('year_built')->nullable();
            $table->json('features')->nullable();

            // Owner/Contact Information
            $table->string('owner_name');
            $table->string('owner_email');
            $table->string('owner_phone');
            $table->string('preferred_contact')->default('email');

            // Additional Information
            $table->text('additional_info')->nullable();

            // Status and Metadata
            $table->string('status')->default('pending');
            $table->string('ip_address');
            $table->text('user_agent')->nullable();

            // Featured image reference
            $table->unsignedBigInteger('featured_image_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('property_type');
            $table->index('city');
            $table->index('price');
            $table->index('status');
        });

        // Create property images table
        Schema::create('property_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->string('path'); // Path to the image file
            $table->string('caption')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
        });

        // Add foreign key constraint for featured image
        Schema::table('properties', function (Blueprint $table) {
            $table->foreign('featured_image_id')
                ->references('id')
                ->on('property_images')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['featured_image_id']);
        });

        Schema::dropIfExists('property_images');
        Schema::dropIfExists('properties');
    }
};
