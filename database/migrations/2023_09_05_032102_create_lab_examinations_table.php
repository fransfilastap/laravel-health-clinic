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
        Schema::create('lab_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medical_record_id');
            $table->unsignedBigInteger('lab_id');
            $table->string('result');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('lab_id')->references('id')->on('lab_registries');
            $table->foreign('medical_record_id')->references('id')->on('medical_records');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_examinations');
    }
};
