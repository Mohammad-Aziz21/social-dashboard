<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('username')->unique();
            $table->string('image');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('insurance_barmer')->nullable();
            $table->string('car_degree')->nullable();
            $table->integer('created_by')->default('1');
            $table->integer('updated_by')->default('1');
            $table->enum('status', ['Active', 'InActive'])->default('Active');
            $table->datetime('last_login')->nullable();


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
};
