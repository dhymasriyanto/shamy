<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKurikulumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kurikulum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama', 20)->comment('Nama kurikulum');
            $table->string('aturan_lulus', 20);
            $table->string('aturan_wajib', 20);
            $table->string('aturan_pilihan', 20);
            $table->json('matakuliah')->comment('Id Mata Kuliah');
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
        Schema::dropIfExists('kurikulum');
    }
}
