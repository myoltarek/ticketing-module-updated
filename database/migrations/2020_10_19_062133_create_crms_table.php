<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agent_name');
            $table->string('customer_name');
            $table->string('customer_contact');
            $table->integer('district_id')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->string('profession')->nullable();
            $table->integer('query_type_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('complain_type_id')->unsigned()->nullable();
            $table->integer('call_remark_id')->unsigned()->nullable();
            $table->text('verbatim')->nullable();
            $table->timestamps();
        });

        Schema::table('crms', function(Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('query_type_id')->references('id')->on('query_types');
            $table->foreign('complain_type_id')->references('id')->on('complain_types');
            $table->foreign('call_remark_id')->references('id')->on('call_remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crms');
    }
}
