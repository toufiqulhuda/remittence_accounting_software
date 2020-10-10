<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhousedetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhousedetail', function (Blueprint $table) {
            $table->string('ExHouseID');
            $table->string('ExHouseName');
            $table->string('ExParentID');
            $table->string('Address');
            $table->bigInteger('CountryID');
            $table->date('TnxDate');
            $table->date('PrevDate');
            $table->string('RespExID');
            $table->string('ShortName');

            $table->bigInteger('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exhousedetail');
    }
}
