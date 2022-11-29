<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnReleaseCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('press_releases', function (Blueprint $table) {
            $table->integer('release_category_id');
        });

        Schema::create('report_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
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
        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropColumn('release_category_id');
        });

        Schema::dropIfExists('report_categories');
    }
}
