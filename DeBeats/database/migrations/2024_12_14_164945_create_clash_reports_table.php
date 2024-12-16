

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
        Schema::create('clash_reports', function (Blueprint $table) {
            $table->id();
            $table->string('UTMID');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('course_code');
            $table->enum('status', ['pending', 'successful']); // status can be pending or successful
            $table->timestamps();
        });
    }
   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clash_reports');
    }
};
