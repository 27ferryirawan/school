<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianDetailPilganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ujian_detail_pilgan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_detail_id');
            $table->integer('no_jawaban')->nullable();
            $table->text('jawaban')->nullable();
            $table->integer('is_jawaban')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('ujian_detail_id')
                ->references('id')
                ->on('ujian_detail')
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
        Schema::dropIfExists('ujian_detail_pilgan');
    }
}
