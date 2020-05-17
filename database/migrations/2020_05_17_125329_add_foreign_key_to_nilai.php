<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_mengajar');
            $table->foreign('id_mengajar')->references('id')->on('mengajar')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            //
        });
    }
}
