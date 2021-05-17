<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearClosingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_closing_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Type_name',100);
            $table->string('COACode',8);
            $table->decimal('Balance',18, 2);
            $table->string('ExHouseID',11);
            $table->date('Year_Closing_Date');
            $table->date('Year_Closing_Execution');
            $table->string('Remarks',100);
            $table->bigInteger('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('year_closing_details');
    }
}
