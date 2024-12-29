<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestListTable extends Migration
{
    public function up(): void
    {
        Schema::create('test_list', function (Blueprint $table) {
            $table->id();
            $table->string('course_code'); 
            $table->string('course_name');
            $table->integer('capacity');
            $table->date('exam_date');
            $table->string('duration');
            $table->string('exam_type');
            $table->string('type');
            $table->string('venue_short');
            $table->string('file_path')->nullable(); // Store file path
            $table->foreignId('UTMID')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_list');
    }
}
