<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExhouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhouse', function (Blueprint $table) {
            $table->string('ExHouseID',11)->primary();
            $table->string('ExHouseName',100);
            $table->string('ExParentID',11);
            $table->string('Address');
            //$table->bigInteger('CountryID')->unsigned();
            $table->foreignId('CountryID')->constrained('country')->onDelete('cascade');
            //$table->bigInteger('CurrencyID')->unsigned();
            $table->foreignId('CurrencyID')->constrained('currency')->onDelete('cascade');
            $table->date('TnxDate');
            $table->date('PrevDate');
            $table->string('RespExID',11);
            $table->string('ShortName',50);
            $table->tinyInteger('isactive')->default(0);
            $table->bigInteger('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('UpdatedBy')->nullable();
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
        Schema::dropIfExists('exhouse');
    }
}
