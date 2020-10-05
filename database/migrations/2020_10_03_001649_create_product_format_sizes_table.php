<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFormatSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_format_sizes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("format_id");
            $table->unsignedBigInteger("size_id");
            $table->double("price");
            $table->text("description");
            $table->string("slug");
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade');
            $table->foreign('format_id')->references('id')->on('formats')->onUpdate('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_format_sizes');
    }
}
