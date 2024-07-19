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
        Schema::create('computations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('subject_code')->index();
            $table->foreign('subject_code')->references('subject_code')->on('subjects')->onDelete('cascade');
            $table->integer('total_score')->index();
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
        Schema::dropIfExists('computations');
    }
};
