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
        Schema::create('plot_subdivisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('land_parcel_id')->constrained()->onDelete('cascade');
            $table->foreignId('parent_plot_id')->nullable()->constrained('plots')->onDelete('cascade');
            $table->string('subdivision_reference');
            $table->date('subdivision_date');
            $table->text('survey_details')->nullable();
            $table->string('approval_number')->nullable();
            $table->date('approval_date')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_subdivisions');
    }
};
