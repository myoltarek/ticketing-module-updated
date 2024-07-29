<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCrms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crms', function (Blueprint $table) {
            $table->string('call_type')->after('customer_contact');
            $table->string('caller_type')->after('customer_contact');
            $table->string('verification_code')->after('customer_contact')->nullable();
            $table->string('proprietor_name')->after('customer_contact')->nullable();
            $table->string('distributor_name')->after('customer_contact')->nullable();
            $table->string('designation')->after('customer_contact')->nullable();
            $table->string('region')->after('customer_contact')->nullable();
            $table->string('territory')->after('customer_contact')->nullable();
            $table->string('area')->after('customer_contact')->nullable();
            $table->string('dealer_division')->after('customer_contact')->nullable();
            $table->string('wing_name')->after('customer_contact')->nullable();
            $table->string('customer_gender')->after('customer_contact');
            $table->string('alternate_number')->after('customer_contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crms', function (Blueprint $table) {
            $table->dropColumn('call_type');
            $table->dropColumn('caller_type');
            $table->dropColumn('verification_code');
            $table->dropColumn('proprietor_name');
            $table->dropColumn('distributor_name');
            $table->dropColumn('designation');
            $table->dropColumn('region');
            $table->dropColumn('territory');
            $table->dropColumn('area');
            $table->dropColumn('dealer_division');
            $table->dropColumn('wing_name');
            $table->dropColumn('customer_gender');
        });
    }
}
