<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianJawabanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ujian_jawaban_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ujian_jawaban_id');
            $table->unsignedBigInteger('jenis_soal_id');
            $table->unsignedBigInteger('ujian_detail_id');
            $table->unsignedBigInteger('ujian_detail_pilgan_id')->nullable();
            $table->text('jawaban_deskripsi')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('ujian_detail_id')
                ->references('id')
                ->on('ujian_detail')
                ->onDelete('cascade');

            $table->foreign('ujian_jawaban_id')
                ->references('id')
                ->on('ujian_jawaban')
                ->onDelete('cascade');

            $table->foreign('jenis_soal_id')
                ->references('id')
                ->on('jenis_soal')
                ->onDelete('cascade');

            $table->foreign('ujian_detail_pilgan_id')
                ->references('id')
                ->on('ujian_detail_pilgan')
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
        Schema::dropIfExists('ujian_jawaban_detail');
    }
}
