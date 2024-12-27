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
        Schema::create('lecturer', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('UTMID');
            $table->string('name'); // Column for lecturer name
            $table->string('course_code');  // Column for course code
            $table->timestamps(); // Created at and Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer');
    }
};
