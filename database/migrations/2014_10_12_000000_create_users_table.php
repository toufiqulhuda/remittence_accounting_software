<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('name',50);
            $table->string('email',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username',20);
            $table->string('password');
            $table->tinyInteger('isactive')->default(0);
            $table->string('ExHouseID',11)->nullable();
            //$table->foreignId('ExHouseID')->constrained('exhouse')->nullable()->onDelete('cascade');
            $table->bigInteger('EmpId')->nullable();
            //$table->foreignId('EmpId')->constrained('employee')->nullable()->onDelete('cascade');
            $table->string('CountryID',5)->nullable();
            //$table->foreignId('CountryID')->constrained('country')->nullable()->onDelete('cascade');
            $table->bigInteger('roleid')->nullable();
            //$table->foreignId('roleid')->constrained('roles')->nullable()->onDelete('cascade');

            $table->bigInteger('CreatedBy');
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('UpdatedBy')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->rememberToken();
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
