<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ujian_jawaban', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_id');
            $table->unsignedBigInteger('siswa_id');
            $table->dateTime('finish_date')->nullable();
            $table->double('nilai')->nullable(); 
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswa')
                ->onDelete('cascade');

            $table->foreign('ujian_id')
                ->references('id')
                ->on('ujian')
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
        Schema::dropIfExists('ujian_jawaban');
    }
}
