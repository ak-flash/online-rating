<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('team_id')->constrained();
            $table->string('title', 100);
            $table->integer('type')->length(1)->default(1);
            $table->foreignId('discipline_id')->constrained();
            $table->date('date');
            $table->time('time_start', 0);
            $table->time('time_end', 0);
            $table->integer('day_type')->length(1)->default(3);
            $table->foreignId('faculty_id')->constrained();
            $table->integer('course_number')->nullable();
            $table->integer('group_number')->nullable();
            $table->string('room', 100)->nullable();
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
        Schema::dropIfExists('lessons');
    }
}
