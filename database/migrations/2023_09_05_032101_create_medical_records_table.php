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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('doctor_id');
            $table->string('complaint');
            $table->string('anamnesis');
            $table->string('physical_examination');
            $table->string('diagnosis');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('patient_id')->on('patients')->references('id');
            $table->foreign('doctor_id')->on('doctors')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
