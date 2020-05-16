<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_nilai');
            $table->foreign('id_nilai')->references('id')->on('nilai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jurusan')->references('id')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign('id_jurusan');
            $table->dropForeign('id_nilai');
        });
    }
}
