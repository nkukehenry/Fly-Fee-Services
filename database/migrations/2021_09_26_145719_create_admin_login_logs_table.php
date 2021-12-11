<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_login_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('admin Id');
            $table->string('user_ip',30);
            $table->string('location',60);
            $table->string('browser',50);
            $table->string('os',50);
            $table->string('longitude',25);
            $table->string('latitude',25);
            $table->string('country',25);
            $table->string('country_code',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_login_logs');
    }
}
