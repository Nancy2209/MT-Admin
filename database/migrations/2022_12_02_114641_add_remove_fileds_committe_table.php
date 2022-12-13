<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRemoveFiledsCommitteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->text('board')->nullable();
            $table->dropColumn('name');
            $table->dropColumn('designation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('designation');
        });
    }
}
