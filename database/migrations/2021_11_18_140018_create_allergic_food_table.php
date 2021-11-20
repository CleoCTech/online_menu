<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllergicFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allergic_food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dish_id')->nullable()->constrained('dishes');
            $table->foreignId('allergene_id')->nullable()->constrained('allergenes');
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
        Schema::dropIfExists('allergic_food');
    }
}