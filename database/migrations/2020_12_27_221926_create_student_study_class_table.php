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
        Schema::create('student_study_class', function (Blueprint $table) {
            $table->foreignId('study_class_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->unique(['study_class_id', 'student_id']);
            $table->integer('mark1')->length(3)->default(0);
            $table->integer('mark2')->length(3)->default(0);
            $table->string('notify',150)->nullable();
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
        Schema::dropIfExists('student_study_class');
    }
}
