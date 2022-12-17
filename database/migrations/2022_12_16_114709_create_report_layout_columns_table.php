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
        Schema::create('report_layout_columns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->unsigned();
            $table->bigInteger('layout_id')->unsigned();
            $table->string('layout_name');
            $table->string('report_name');
            $table->string('column_name');
            $table->integer('column_number');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');
            $table->foreign('layout_id')->references('id')->on('report_layouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_layout_columns');
    }
};
