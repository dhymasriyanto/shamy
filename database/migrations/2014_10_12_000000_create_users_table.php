<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('driver')->comment('Penyedia');
            $table->string('username')->unique()->comment('user id pada penyedia');
            $table->string('name')->comment('Nama user');
            $table->string('email')->unique()->nullable()->comment('Email');
            $table->string('photo')->nullable()->comment('Photo profiles');
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->nullable()->comment('Peran');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->bigInteger('id_mahasiswa')->nullable()->comment('untuk get data mahasiswa');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
