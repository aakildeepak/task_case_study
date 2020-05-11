<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group_name')->nullable();
            $table->string('group_code')->nullable();
            $table->string('conducted_lecturer')->nullable();
            $table->string('description')->nullable();
            $table->string('std_category')->nullable();
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
        Schema::dropIfExists('study_groups');
    }
}
