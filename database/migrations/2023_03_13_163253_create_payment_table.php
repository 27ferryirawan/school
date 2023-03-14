<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('payment_name');
            $table->unsignedBigInteger('payment_type_id'); //1 = E-Money, 2 = Kartu Kredit, 3 = Virtual Acc, 4 = Transfer Bank
            $table->smallinteger('is_available');
            $table->smallinteger('is_connected')->nullable();
            $table->integer('balance')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();
            
            $table->foreign('payment_type_id')
                ->references('id')
                ->on('payment_type')
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
        Schema::dropIfExists('payment');
    }
}
