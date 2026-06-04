<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->string('duration', 100); // e.g., '2 weeks', '3 months'
            $table->foreignId('diagnosis_id')->constrained('diagnoses')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->string('status', 50); // e.g., 'Ongoing', 'Completed'
            $table->string('administration_frequency', 100);
            $table->timestamps();
        });
    }
};
