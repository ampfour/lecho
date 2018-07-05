<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('to')->unsigned();
            $table->string('from');
            $table->string('company');
            $table->string('phone');
            $table->string('email');
            $table->string('order_no');
            $table->string('acct_no');
            $table->integer('user_id')->unsigned();
            $table->enum('type', ['eTraining', 'Streaming', 'Other']);
            $table->text('message');
            $table->enum('status', ['Open', 'In-Process', 'On-Hold', 'Complete', 'Cancelled']);
            $table->text('notes');
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
        Schema::dropIfExists('tickets');
    }
}
