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
        Schema::create('course_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status',['active','deactive'])->default('active');
            $table->timestamps();
        });

        DB::table('course_types')->insert(
            array(
                [
                 'name' => 'Competative Exams',
                ],
                [
                    'name' => 'Colleges',
                 ],
                  [
                    'name' => 'School',
                ],
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_types');
    }
};
