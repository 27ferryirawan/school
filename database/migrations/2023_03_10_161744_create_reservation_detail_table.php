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
            $table->id();
            $table->smallinteger('status'); //0 = available, 1 = on reserve, 2 = guest in , 3 = guest out, 4 = cancel
            $table->unsignedBigInteger('reservation_id');
            $table->string('table_id');
            $table->datetime('reservation_date');
            $table->integer('fee');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('reservation_id')
                ->references('id')
                ->on('reservation')
                ->onDelete('cascade');

            $table->foreign('table_id')
                ->references('id')
                ->on('table_detail')
                ->onDelete('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('updated_by')
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
        Schema::dropIfExists('reservation_detail');
    }
}
