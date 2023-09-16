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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_birth');
            $table->string('name');
            $table->enum('sex',['MALE','FEMALE'])->index('sexIndex');
            $table->string('social_number');
            $table->text('address')->nullable();
            $table->string('mobile_phone');
            $table->string('education');
            $table->string('allergic');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
