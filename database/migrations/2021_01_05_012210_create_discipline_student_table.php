<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplineStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipline_student', function (Blueprint $table) {
            $table->foreignId('discipline_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->unique(['discipline_id', 'student_id']);
            $table->integer('missed_classes_count')->length(3)->default(0);
            $table->integer('missed_lectures_count')->length(3)->default(0);
            $table->integer('negative_marks_count')->length(3)->default(0);
            $table->float('rating')->default(0);
            $table->string('notify',150)->nullable();
            $table->auditable();
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
        Schema::dropIfExists('discipline_student');
    }
}
