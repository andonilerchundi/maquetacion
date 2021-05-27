<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('oz_id');
            $table->string('color');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->decimal('iva_id', $precision = 8, $scale = 2);
            $table->decimal('total_price', $precision = 8, $scale = 2);
            $table->boolean('active');
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
        Schema::dropIfExists('t_product');
    }
}
