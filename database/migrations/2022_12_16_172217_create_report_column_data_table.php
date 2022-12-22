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
        Schema::create('report_column_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('report_id')->unsigned();
            $table->bigInteger('column_id')->unsigned();
            $table->string('column_name');
            $table->string('column_data');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('report_id')
            ->references('id')
            ->on('reports')
            ->onDelete('cascade');
            $table->foreign('column_id')
            ->references('id')
            ->on('report_layout_columns')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_column_data');
    }
};
