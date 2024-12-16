<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{
    
    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('unit_number', 50); // Unit number, max length 50
            $table->string('venue_name'); // Full venue name
            $table->string('venue_short', 10); // Short form of the venue name, max length 10
            $table->enum('type', ['makmal', 'bilik kuliah']); // Type of venue
            $table->integer('capacity'); // Capacity of the venue
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};