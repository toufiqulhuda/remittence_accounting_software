<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountMainHeadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_main_head', function (Blueprint $table) {
            $table->string('AccHdID',1)->primary();
            $table->string('AcctHdName',50);
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
        Schema::dropIfExists('account_main_head');
    }
}
