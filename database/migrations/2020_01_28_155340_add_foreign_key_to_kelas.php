<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jurusan');
            $table->foreign('id_jurusan')->references('id')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->foreign('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_kurikulum');
            $table->foreign('id_kurikulum')->references('id')->on('kurikulum')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_mata_kuliah');
            $table->foreign('id_mata_kuliah')->references('id')->on('mata_kuliah')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('id_jurusan');
            $table->foreign('id_tahun_ajaran');
            $table->foreign('id_kurikulum');
            $table->foreign('id_mata_kuliah');
        });
    }
}
