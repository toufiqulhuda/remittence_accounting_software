<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empdetail', function (Blueprint $table) {
            $table->bigIncrements('EmpId');
            $table->string('EmpName');
            $table->string('ExHouseID');
            $table->string('ContactNo');
            $table->string('PassportNo');
            $table->string('PermanentAddress');
            $table->string('PresentAddress');
            $table->date('JoinDate');
            $table->bigInteger('DegId');
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
        Schema::dropIfExists('empdetail');
    }
}
