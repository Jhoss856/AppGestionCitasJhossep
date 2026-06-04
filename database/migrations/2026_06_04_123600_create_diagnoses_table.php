<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('diagnoses', function (Blueprint $table) {
        $table->id();
        $table->text('description');
        $table->dateTime('date');
        $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
        $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
        $table->string('severity', 50); // e.g., 'Mild', 'Moderate', 'Severe'
        $table->text('recommendations')->nullable();
        $table->string('diagnosis_type', 100);
        $table->timestamps();
    });
}
};
