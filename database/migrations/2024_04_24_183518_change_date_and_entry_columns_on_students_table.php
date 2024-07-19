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
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'DateofBirth',
                'Entryyear'
            ]);
            $table->date('date_of_birth')->nullable();
            $table->unsignedInteger('entry_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'entry_year'
            ]);
            $table->integer('DateofBirth');
            $table->integer('Entryyear');
            
        });
    }
};
