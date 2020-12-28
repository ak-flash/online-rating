<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('document_id', 50)->unique();
            $table->string('name', 190);
            $table->foreignId('faculty_id')->constrained();
            $table->integer('course_number')->nullable();
            $table->integer('group_number')->nullable();
            $table->string('email', 100)->unique();
            $table->string('password', 191)->nullable();
            $table->boolean('active')->default(true);
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('students');
    }
}
