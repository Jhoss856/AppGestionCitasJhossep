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
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('dosage', 100); // e.g., '500mg'
            $table->string('frequency', 100); // e.g., 'Every 8 hours'
            $table->string('duration', 100); // e.g., '5 days'
            $table->foreignId('treatment_id')->constrained('treatments')->onDelete('cascade');
            $table->string('supplier', 150)->nullable();
            $table->string('side_effects', 255)->nullable(); 
            $table->timestamps();
        });
    }
};
