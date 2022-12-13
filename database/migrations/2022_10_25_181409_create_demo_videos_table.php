<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemoVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demo_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('title')->nullable();
            $table->string('video_url')->nullable();
            $table->string('video_name')->nullable();
            $table->text('description')->nullable();
            $table->string('subject_tag')->nullable();
            $table->string('standard_tag')->nullable();
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('class_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demo_videos');
    }
}
