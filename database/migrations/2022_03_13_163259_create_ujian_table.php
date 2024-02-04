<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ujian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_pembelajaran_id');
            $table->unsignedBigInteger('jenis_ujian_id');
            $table->text('deskripsi')->nullable();
            $table->string('kode_ruangan')->nullable();
            $table->integer('waktu_pengerjaan')->nullable();
            $table->dateTime('tanggal_ujian')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('guru_pembelajaran_id')
                ->references('id')
                ->on('guru_pembelajaran')
                ->onDelete('cascade');

            $table->foreign('jenis_ujian_id')
                ->references('id')
                ->on('jenis_ujian')
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
        Schema::dropIfExists('ujian');
    }
}
