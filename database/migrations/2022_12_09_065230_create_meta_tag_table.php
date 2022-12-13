<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->nullable();
            $table->string('mata_title')->nullable();
            $table->string('mata_keyboard')->nullable();
            $table->text('mata_description')->nullable();
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
        Schema::dropIfExists('meta_tags');
    }
}
