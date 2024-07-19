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
        Schema::table('result_sheets', function (Blueprint $table) {
            $table->dropForeign('result_sheets_student_id_foreign');
            $table->dropForeign('result_sheets_subject_code_foreign');

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_code')->references('subject_code')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result_sheets', function (Blueprint $table) {
            $table->dropForeign('result_sheets_student_id_foreign');

            $table->foreign('student_id')->references('id')->on('students');
            
            $table->dropForeign('result_sheets_subject_code_foreign');
            
            $table->foreign('subject_code')->references('subject_code')->on('subjects');
        });
    }
};
