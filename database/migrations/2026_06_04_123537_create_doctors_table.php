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
    Schema::create('doctors', function (Blueprint $table) {
        $table->id();
        $table->string('first_name', 100);
        $table->string('last_name', 100);
        $table->string('specialty', 100);
        $table->string('phone', 20)->nullable();
        $table->string('email', 150)->unique()->nullable();
        $table->string('license', 50)->unique();
        $table->integer('years_of_experience')->nullable();
        $table->timestamps();
    });
}
};
