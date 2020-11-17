<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartOfAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chart_of_account', function (Blueprint $table) {
            $table->string('COACode',8)->primary()->unique();
            $table->string('AccountName',100);
            $table->integer('AccHdID')->nullable();
            $table->integer('AccGrID')->nullable();
            $table->integer('AccSbGrID');
            $table->string('ExHouseID',11);
            $table->date('OpenDate');
            $table->double('Balance', 18, 3)->nullable();
            $table->integer('RptHeadID')->nullable();
            $table->integer('DRptlevel')->nullable();
            $table->string('ReportType',1)->nullable();

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
        Schema::dropIfExists('chart_of_account');
    }
}
