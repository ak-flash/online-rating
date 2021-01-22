<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('discipline_id')->nullable()->constrained();
            $table->time('time_start', 0);
            $table->time('time_end', 0);
            $table->integer('week_type_id')->length(1)->default(3);
            $table->integer('day_type_id')->length(1)->default(1);
            $table->foreignId('faculty_id')->constrained();
            $table->year('year');
            $table->integer('semester')->nullable();
            $table->integer('course_number')->nullable();
            $table->integer('group_number')->nullable();
            $table->string('room', 100)->nullable();
            $table->auditableWithDeletes();
            $table->softDeletes();
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
        Schema::dropIfExists('journals');
    }
}
