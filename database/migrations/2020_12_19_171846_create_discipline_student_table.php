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
            $table->integer('discipline_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->unique(['student_id', 'discipline_id']);
            $table->float('rating')->length(3)->default(0);
            $table->string('notify',150)->default('');
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
