<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_induk', 255)->comment('Nomor induk mahasiswa')->nullable()->unique();
            $table->string('nama', 255)->comment('Nama mahasiswa')->nullable();
            $table->json('status_aktif')->comment('Status aktif/tidak aktif mahasiswa berdasarkan pembayaran melalui sistem pembayaran terpisah')->nullable();
            $table->string('jenis_pendaftaran', 255)->comment('Jenis Pendaftaran')->nullable();
            $table->string('jenis_kelamin', 255)->comment('Jenis Kelamin')->nullable();
            $table->string('tempat_lahir', 255)->comment('Tempat Lahir')->nullable();
            $table->date('tanggal_lahir')->comment('Tanggal Lahir')->nullable();
            $table->string('agama', 255)->comment('Agama')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->integer('created_by')->default(0);
            $table->timestamp('updated_at')->useCurrent();
            $table->integer('updated_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
