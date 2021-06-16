<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('password');
            $table->string('email', 128)->unique();
            $table->string('phone', 14)->nullable();
            $table->string('status')->default('active');
            $table->longText('api_token')->nullable();
            $table->time('token_expiration')->nullable();
            $table->unsignedBigInteger('profile_id');
            $table->timestamps();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
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
