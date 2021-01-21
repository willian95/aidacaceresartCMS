<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSoldToProductFormatSizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_format_sizes', function (Blueprint $table) {
            $table->boolean("is_sold")->default(0); //en caso de que decidad utilizar formatos y tamaños
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_format_sizes', function (Blueprint $table) {
            //
        });
    }
}
