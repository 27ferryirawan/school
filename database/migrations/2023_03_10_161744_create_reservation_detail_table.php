<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_detail', function (Blueprint $table) {
            $table  ->id()
                    ->unsignedBigInteger('reservation_id')
                    ->string('table_id')
                    ->datetime('reservation_date')
                    ->integer('fee')
                    ->timestamps();

            $table  ->foreign('reservation_id')
                    ->references('id')
                    ->on('reservation')
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
        Schema::dropIfExists('reservation_detail');
    }
}
