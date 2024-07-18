<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn('prefecture');
            $table->dropColumn('genre');
            $table->foreignId('prefecture_id')->nullable();
            $table->foreignId('genre_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->string('prefecture');
            $table->string('genre');
            $table->dropForeign(['prefecture_id']);
            $table->dropForeign(['genre_id']);
            $table->dropColumn('prefecture_id');
            $table->dropColumn('genre_id');
        });
    }
}
