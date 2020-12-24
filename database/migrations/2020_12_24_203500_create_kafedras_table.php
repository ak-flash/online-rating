<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKafedrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kafedras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->comment('Moderator Id');
            $table->string('name', 100);
            $table->string('phone', 15)->nullable();
            $table->text('adress')->nullable();
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
        Schema::dropIfExists('kafedras');
    }
}
