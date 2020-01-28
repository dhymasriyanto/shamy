<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable()->comment('User ID');
            $table->string('token_type')->nullable()->comment('Type token');
            $table->integer('expires_in')->nullable()->comment('Token expired');
            $table->text('access_token')->nullable()->comment('User token');
            $table->text('refresh_token')->nullable()->comment('Refresh token');
            $table->string('user_agent')->nullable()->comment('User agent');
            $table->string('ip')->nullable()->comment('IP address');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token_info');
    }
}
