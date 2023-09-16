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
        Schema::create('advised_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_record_id');
            $table->string('medicine_name');
            $table->string('dose');
            $table->string('unit');
            $table->string('instruction');
            $table->timestamps();

            $table->foreign('medical_record_id')->references('id')->on('medical_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advised_prescriptions');
    }
};
