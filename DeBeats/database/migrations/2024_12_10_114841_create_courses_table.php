<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCoursesTable extends Migration
{
   
    // In your CreateCoursesTable migration
// In your CreateCoursesTable migration
public function up(): void
{
    Schema::create('courses', function (Blueprint $table) {
        $table->id();
        $table->string('course_code')->unique(); // Add a unique constraint to course_code
        $table->string('course_name');
        $table->integer('capacity');
        $table->timestamps();
    });
}






   
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
