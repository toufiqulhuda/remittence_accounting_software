<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSubGroupDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_sub_group_detail', function (Blueprint $table) {
            $table->increments('AccSbGrID');
            $table->char('AccSbGrCode',5);
            $table->string('AccSbGrName',100);
            $table->integer('AccGrID');
            $table->char('ExHouseID',11);

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
        Schema::dropIfExists('account_sub_group_detail');
    }
}
