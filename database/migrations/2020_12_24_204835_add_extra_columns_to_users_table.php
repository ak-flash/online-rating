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
            $table->dropColumn('current_team_id');
            $table->string('phone_number', 15)->nullable()->unique();
            $table->integer('position')->length(2)->default(1);
            $table->integer('role')->length(2)->default(3);
            $table->boolean('active')->default(true);
            $table->foreignId('department_id')->nullable()->constrained();
            // $table->text('profile_photo_path')->nullable();
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
            $table->dropColumn('phone_number', 'position', 'role', 'active', 'department_id', 'date_of_birth');
        });
    }
}
