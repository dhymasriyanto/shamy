<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToMengajar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mengajar', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id')->on('jurusan');
            $table->unsignedBigInteger('id_kelas');
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->unsignedBigInteger('id_dosen');
            $table->foreign('id_dosen')->references('id')->on('dosen');
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->foreign('id_mata_kuliah')->references('id')->on('mata_kuliah');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')->references('id')->on('tahun_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mengajar', function (Blueprint $table) {
            $table->foreign('id_jurusan');
            $table->foreign('id_kelas');
            $table->foreign('id_dosen');
            $table->foreign('id_mata_kuliah');
            $table->foreign('id_tahun_ajaran');
        });
    }
}
