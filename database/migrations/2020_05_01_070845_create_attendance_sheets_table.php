<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lecturer_id')->nullable();
            $table->string('course_type')->nullable();
            $table->string('course_id')->nullable();
            $table->string('hours')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_sheets');
    }
}
