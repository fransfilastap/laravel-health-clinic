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
        Schema::table('medical_records', function (Blueprint $table) {
            $table->unsignedBigInteger('legacy_id')->nullable();
            $table->string('legacy_lab_examinations')->nullable();
            $table->string('legacy_prescriptions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_records', function (Blueprint $table) {
            $table->removeColumn('legacy_id');
            $table->removeColumn('legacy_lab_examinations');
        });
    }
};
