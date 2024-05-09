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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->default('1');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->default('1');
            $table->enum('status', ['Open', 'In progress', 'Done'])->default('Open');
            $table->string('due_date');
            $table->string('public_details');
            $table->string('reminder_date');
            $table->text('step_1_description');
            $table->string('step_1_file');
            $table->text('step_2_description');
            $table->string('step_2_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
};
