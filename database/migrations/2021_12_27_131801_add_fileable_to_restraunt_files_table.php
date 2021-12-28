<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileableToRestrauntFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restraunt_files', function (Blueprint $table) {
            $table->unsignedBigInteger('fileable_id')->nullable()->after('filename');
            $table->string('fileable_type')->nullable()->after('fileable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restraunt_files', function (Blueprint $table) {
            $table->dropColumn('fileable_id');
            $table->dropColumn('fileable_type');
        });
    }
}
