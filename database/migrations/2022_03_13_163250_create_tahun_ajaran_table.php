<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAjaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_ajaran');
    }
}


// Schema::create('payment', function (Blueprint $table) {
//             $table->id();
//             $table->string('payment_name');
//             $table->unsignedBigInteger('payment_type_id'); //1 = E-Money, 2 = Kartu Kredit, 3 = Virtual Acc, 4 = Transfer Bank
//             $table->smallinteger('is_available');
//             $table->smallinteger('is_connected')->nullable();
//             $table->integer('balance')->nullable();
//             $table->string('logo_path')->nullable();
//             $table->timestamps();
            
//             $table->foreign('payment_type_id')
//                 ->references('id')
//                 ->on('payment_type')
//                 ->onDelete('cascade');

//         });


// Schema::create('reservation', function (Blueprint $table) {
//             $table->id();
//             $table->unsignedBigInteger('payment_type_id'); //1 = E-Money, 2 = Kartu Kredit, 3 = Virtual Acc, 4 = Transfer Bank
//             $table->unsignedBigInteger('payment_id'); 
//             $table->integer('total_fee');
//             $table->unsignedBigInteger('created_by');
//             $table->unsignedBigInteger('updated_by')->nullable();
//             $table->timestamps();

//             $table->foreign('payment_type_id')
//                 ->references('id')
//                 ->on('payment_type')
//                 ->onDelete('cascade');

//             $table->foreign('payment_id')
//                 ->references('id')
//                 ->on('payment')
//                 ->onDelete('cascade');

//             $table->foreign('created_by')
//                 ->references('id')
//                 ->on('users')
//                 ->onDelete('cascade');

//             $table->foreign('updated_by')
//                 ->references('id')
//                 ->on('users')
//                 ->onDelete('cascade');
//         });