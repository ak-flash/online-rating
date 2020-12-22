<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentStudyClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_student', function (Blueprint $table) {
            $table->integer('lesson_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->unique(['lesson_id', 'student_id']);
            $table->integer('mark1')->length(3)->default(0);
            $table->integer('mark2')->length(3)->default(0);
            $table->string('notify',150)->default('');
            $table->boolean('attendance')->default(0);
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('lesson_student');
    }
}
