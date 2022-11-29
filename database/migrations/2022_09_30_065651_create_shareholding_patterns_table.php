<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shareholding_patterns', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable();
            $table->string('file_title')->nullable();
            $table->string('pattern_code')->nullable();
            $table->string('quarter_name')->nullable();
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
        Schema::dropIfExists('shareholding_patterns');
    }
};
