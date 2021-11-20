<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRestaurantIdToAllergenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('allergenes', function (Blueprint $table) {
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
        Schema::table('allergenes', function (Blueprint $table) {
            $table->dropColumn('restaurant_id');
        });
    }
}