<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurantIdToDishCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dish_categories', function (Blueprint $table) {
            $table->foreignId('restaurant_id')->nullable()->after('name')->constrained('restraunts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dish_categories', function (Blueprint $table) {
            $table->dropColumn('restaurant_id');
        });
    }
}
