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
        Schema::create('report_layout_defaults', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->unsigned();
            $table->bigInteger('layout_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('layout_name');
            $table->string('report_name');
            $table->timestamps();
            $table->unique(['report_id', 'layout_id', 'user_id']);
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('layout_id')->references('id')->on('report_layouts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_layout_defaults');
    }
};
