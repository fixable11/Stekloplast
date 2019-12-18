<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('portfolio_photos', function (Blueprint $table) {
//            $table->increments('id');
//            $table->unsignedInteger('portfolio_id');
//            $table->string('path')->unique();
//
//            $table->foreign('portfolio_id')->references('id')->on('portfolio');
//        });
        Schema::table('portfolio', function (Blueprint $table) {
            $table->json('photos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolio', function (Blueprint $table) {
            $table->dropColumn('photos');
        });
//        Schema::table('portfolio_photos', function (Blueprint $table) {
//            $table->dropForeign('portfolio_photos_portfolio_id_foreign');
//        });
//        Schema::dropIfExists('portfolio_photos');
    }
}
