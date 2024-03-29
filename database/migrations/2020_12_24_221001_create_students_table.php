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
            $table->string('document_id')->unique();
            $table->string('name')->nullable();
            $table->string('last_name');
            $table->foreignId('faculty_id')->constrained();
            $table->integer('course_number')->nullable();
            $table->integer('group_number')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 15)->nullable()->unique();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->boolean('active')->default(true);
            $table->boolean('chief')->default(false);
            $table->text('profile_photo_path')->nullable();
            $table->date('date_of_birth')->nullable();
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
        Schema::dropIfExists('students');
    }
}
