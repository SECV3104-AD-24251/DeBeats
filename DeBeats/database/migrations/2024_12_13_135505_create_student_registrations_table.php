<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateStudentRegistrationsTable extends Migration
{
   
    public function up(): void
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('UTMID'); // Student ID
            $table->string('course_code'); // Course code to reference the course
            $table->timestamps();


            // Set up the foreign key constraint for course_code
            $table->foreign('course_code')
                  ->references('course_code') // Linking to the course_code in the courses table
                  ->on('courses')
                  ->onDelete('cascade'); // Optional: Deletes registration if the course is deleted


            // Add a unique constraint for 'UTMID' and 'course_code'
            $table->unique(['UTMID', 'course_code']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrations');
    }
};