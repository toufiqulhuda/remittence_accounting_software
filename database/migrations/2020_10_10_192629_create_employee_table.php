<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('EmpId');
            $table->string('EmpName',50);
            $table->string('ExHouseID',11);
            $table->string('ContactNo',20);
            $table->string('PassportNo',20);
            $table->string('PermanentAddress');
            $table->string('PresentAddress');
            $table->date('JoinDate');
            $table->bigInteger('DegId',2);
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
        Schema::dropIfExists('employee');
    }
}
