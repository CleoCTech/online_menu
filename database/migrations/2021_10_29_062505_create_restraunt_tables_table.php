<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestrauntTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restraunt_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restraunt_id')->nullable()->constrained('restraunts');
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('restraunt_tables');
    }
}