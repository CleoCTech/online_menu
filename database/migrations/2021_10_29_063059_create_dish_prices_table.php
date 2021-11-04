<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dish_id')->nullable()->constrained('dishes');
            $table->float('price');
            $table->foreignId('category_id')->nullable()->constrained('price_categories');
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
        Schema::dropIfExists('dish_prices');
    }
}