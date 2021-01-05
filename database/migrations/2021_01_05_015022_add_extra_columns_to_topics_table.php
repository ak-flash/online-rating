<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraColumnsToTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->foreignId('discipline_id')->constrained();
            $table->integer('t_number')->length(2);
            $table->string('title');
            $table->unique(['t_number', 'discipline_id']);
            $table->auditableWithDeletes();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->dropAuditableWithDeletes();
            $table->dropSoftDeletes();
            $table->dropColumn('title', 't_number', 'discipline_id');
        });
    }
}
