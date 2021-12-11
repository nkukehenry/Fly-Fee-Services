<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryServiceChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_service_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('country_service_id')->nullable();
            $table->integer('level')->nullable();
            $table->decimal('amount',11,2)->nullable();
            $table->boolean('type')->default(2)->comment('1=> Fixed Charge, 2=> (*) Percent Charge');
            $table->decimal('charge',11,2)->default(0);
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
        Schema::dropIfExists('country_service_charges');
    }
}
