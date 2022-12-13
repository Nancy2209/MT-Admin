<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCronicalTagMeataDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->text('canonical_tag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meta_tags', function (Blueprint $table) {
            $table->dropColumn('canonical_tag');
        });
    }
}
