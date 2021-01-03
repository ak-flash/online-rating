<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('short_name', 20)->nullable();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('faculty_id')->constrained();
            $table->integer('semester')->length(2)->default(1);
            $table->integer('last_class_id')->length(2)->default(1);
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
        Schema::dropIfExists('disciplines');
    }
}
