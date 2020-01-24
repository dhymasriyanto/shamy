<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMengajar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mengajar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('jurusan_id','2');
            $table->char('kelas_id','2');
            $table->char('dosen_id','2');
            $table->char('mata_kuliah_id','2');
            $table->char('tahun_jaran_id','2');
            $table->timestamps();
            $table->char('create_by');
            $table->char('update_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mengajar');
    }
}
