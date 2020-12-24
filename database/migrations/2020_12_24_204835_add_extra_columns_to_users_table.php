<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 15)->nullable()->unique();
            $table->integer('position')->length(2)->default(0);
            $table->integer('role')->length(2)->default(3);
            $table->boolean('active')->default(true);
            $table->foreignId('kaferda_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->date('date_of_birth')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone', 'position', 'role', 'active', 'kaferda_id', 'profile_photo_path', 'date_of_birth');
        });
    }
}
