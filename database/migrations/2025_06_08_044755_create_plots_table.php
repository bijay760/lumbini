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
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_parcel_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_plot_id')->nullable()->constrained('plots')->onDelete('set null');
            $table->string('plot_number');
            $table->decimal('area', 15, 2);
            $table->string('dimensions')->nullable();
            $table->string('facing_direction')->nullable();
            $table->string('status')->default('available');
            $table->decimal('price_per_unit', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->boolean('is_subdividable')->default(false);
            $table->boolean('is_subdivided')->default(false);
            $table->text('features')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['land_parcel_id', 'plot_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
