<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->integer('VoucherNo');
            $table->date('VoucherDate');
            $table->string('ExHouseID',11);
            $table->string('Particulars',500)->nullable();
            $table->string('COACode',8);
            $table->char('TnxType',1);
            $table->decimal('DrAmt',18,3);
            $table->decimal('CrAmt',18,3);
            $table->integer('Status');
            $table->integer('IsFT')->nullable();
            $table->integer('VrSlNo')->nullable();
            $table->integer('IsPrintable')->nullable();
            $table->bigInteger('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('AuthorizeBy')->nullable();
            $table->timestamp('AuthorizeDate')->nullable();
            $table->rememberToken();
            $table->primary(['VoucherNo', 'VoucherDate','ExHouseID']);

        });

        // Schema::table('transactions', function($table)
        // {
        //     $table->primary(array('VoucherNo', 'VoucherDate','ExHouseID'));
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
