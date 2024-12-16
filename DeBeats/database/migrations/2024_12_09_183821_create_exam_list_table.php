<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamListTable extends Migration
{
    public function up(): void
    {
        Schema::create('exam_list', function (Blueprint $table) {
            $table->id();
            $table->string('course_code'); // Make sure this is defined as a string
            $table->string('course_name');
            $table->date('exam_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('capacity');
            $table->string('venue_short');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_list');
    }
}
