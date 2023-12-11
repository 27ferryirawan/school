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
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('jenis_ujian_id');
            $table->string('deskripsi');
            $table->string('kode_ruangan')->nullable();
            $table->integer('waktu_pengerjaan')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('guru_id')
                ->references('id')
                ->on('guru')
                ->onDelete('cascade');

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onDelete('cascade');

            $table->foreign('tahun_ajaran_id')
                ->references('id')
                ->on('tahun_ajaran')
                ->onDelete('cascade');
                
            $table->foreign('mata_pelajaran_id')
                ->references('id')
                ->on('mata_pelajaran')
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
