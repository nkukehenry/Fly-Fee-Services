<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('background_color',10)->nullable()->comment('background-color');
            $table->string('background_alternative_color',10)->nullable()->comment('brand-color-light');
            $table->string('secondary_background_color',10)->nullable()->comment('background-color-alt');
            $table->string('base_color',10)->nullable()->comment('brand-color');
            $table->string('secondary_color',10)->nullable()->comment('brand-color-alt');
            $table->string('secondary_alternative_color',10)->nullable()->comment('brand-color-alt-dark');
            $table->string('title_color',10)->nullable()->comment('title-color');
            $table->string('text_color',10)->nullable()->comment('text-color');
            $table->string('natural_color',10)->nullable()->comment('natural-color');
            $table->string('border_color',10)->nullable()->comment('border-color');
            $table->string('error_color',10)->nullable()->comment('error');
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
        Schema::dropIfExists('colors');
    }
}
