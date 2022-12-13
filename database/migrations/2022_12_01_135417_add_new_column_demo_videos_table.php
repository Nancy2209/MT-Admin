<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnDemoVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demo_videos', function (Blueprint $table) {
            $table->string('subject_tag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demo_videos', function (Blueprint $table) {
            $table->$table->dropColumn('subject_tag');
        });
    }
}
