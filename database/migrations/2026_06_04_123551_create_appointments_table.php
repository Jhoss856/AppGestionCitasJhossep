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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('appointment_date'); // Evita usar solo 'date' para que no confunda con el tipo de dato
            $table->string('reason', 255);
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->string('status', 50); // e.g., 'Pending', 'Canceled'
            $table->text('notes')->nullable(); 
            $table->string('room', 50)->nullable();
            $table->timestamps();
        });
    }
};
