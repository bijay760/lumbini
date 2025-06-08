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
        Schema::create('land_parcels', function (Blueprint $table) {
            $table->id();

            // Basic identification
            $table->string('title');
            $table->text('description')->nullable();

            // Location details
            $table->string('district');
            $table->string('municipality');
            $table->string('ward_no');
            $table->string('kitta_no');
            $table->string('location')->nullable();
            $table->string('map_coordinates')->nullable();

            // Area details
            $table->decimal('total_area', 15, 2); // in sq.metre
            $table->string('area_unit')->default('sq.metre');
            $table->string('dhoor')->nullable(); // Additional traditional measurement

            // Valuation
            $table->decimal('government_value', 15, 2);
            $table->decimal('market_value', 15, 2)->nullable();
            $table->decimal('thali_amount', 15, 2)->nullable();

            // Transaction details
            $table->date('purchase_date');
            $table->decimal('purchase_price', 15, 2);
            $table->string('purchase_from');
            $table->boolean('has_loan')->default(false);
            $table->decimal('loan_amount', 15, 2)->nullable();
            $table->string('loan_institution')->nullable();

            // Tax and charges
            $table->decimal('government_tax', 15, 2);
            $table->decimal('non_government_charges', 15, 2);
            $table->text('tax_remarks')->nullable();

            // Registration and legal
            $table->string('registration_number')->nullable();
            $table->string('land_type');
            $table->string('ownership_type');

            // Subdivision info
            $table->boolean('is_subdivided')->default(false);
            $table->integer('total_plots')->default(0);
            $table->decimal('area_used', 15, 2)->default(0);

            // Status and metadata
            $table->text('remarks')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        // Additional table for tax/charge breakdown if needed
        Schema::create('land_tax_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_parcel_id')->constrained()->onDelete('cascade');
            $table->string('tax_name');
            $table->decimal('amount', 15, 2);
            $table->string('category'); // 'government' or 'non_government'
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_tax_details');
        Schema::dropIfExists('land_parcels');
    }
};
