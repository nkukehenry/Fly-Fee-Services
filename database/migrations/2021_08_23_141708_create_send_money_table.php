<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_money', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('send_currency_id')->nullable()->comment('Country ID');
            $table->bigInteger('receive_currency_id')->nullable()->comment('Country ID');
            $table->bigInteger('service_id')->nullable()->comment('Service Id');
            $table->bigInteger('country_service_id')->nullable()->comment('Provider Id');
            $table->string('send_curr',10)->nullable()->comment('Country Code');
            $table->string('receive_curr',10)->nullable()->comment('Country Code');
            $table->decimal('rate',18,8)->nullable();
            $table->decimal('send_amount',18,8)->nullable();
            $table->decimal('fees',18,8)->nullable();
            $table->decimal('payable_amount',18,8)->nullable();
            $table->decimal('recipient_get_amount',18,8)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=> Draft/Initiate, 1=> Completed, 2=> Cancelled');
            $table->tinyInteger('payment_status')->default(0)->comment('1=> Completed, 2=> Cancelled, 3 => awaiting');
            $table->dateTime('paid_at')->nullable();
            $table->text('user_information')->nullable();
            $table->bigInteger('admin_id')->nullable();
            $table->text('admin_reply')->nullable();
            $table->bigInteger('invoice');
            $table->softDeletes();
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
        Schema::dropIfExists('send_money');
    }
}
