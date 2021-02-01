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
            $table->integer('crm_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->enum('status', array('NEW','WIP','ANSWERED','CLOSED'))->default('NEW');
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::table('tickets', function(Blueprint $table) {
            $table->foreign('crm_id')->references('id')->on('crms');
            $table->foreign('user_id')->references('user_id')->on('users');
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
