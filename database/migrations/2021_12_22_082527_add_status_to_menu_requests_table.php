<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMenuRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_requests', function (Blueprint $table) {
            $table->enum('status', ['Successful', 'Unsuccessful'])->default('Unsuccessful')->after('screen_resolution');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_requests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
