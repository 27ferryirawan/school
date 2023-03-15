<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->smallinteger('payment_status'); //0 = available, 1 = on reserve, 2 = guest in , 3 = guest out
            $table->unsignedBigInteger('payment_type_id'); //1 = E-Money, 2 = Kartu Kredit, 3 = Virtual Acc, 4 = Transfer Bank
            $table->unsignedBigInteger('payment_id'); 
            $table->integer('total_fee');
            $table->unsignedBigInteger('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_type')
                ->onDelete('cascade');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payment')
                ->onDelete('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('reservation');
    }
}
