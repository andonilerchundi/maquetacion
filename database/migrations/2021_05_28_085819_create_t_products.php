<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_products', function (Blueprint $table) {
            $table->id();
            $table->string('rel_parent', 255);
            $table->integer('key')->nullable(true)->index();
            $table->string('oz_id');
            $table->string('color');
            $table->string('brand_id');
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
        Schema::dropIfExists('t_products');
    }
}
