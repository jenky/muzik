<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtistTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist_track', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artist_id')->unsigned()->default(0);
            $table->integer('track_id')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('tracks', function (Blueprint $table) {
            $table->dropColumn('artist_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artist_track');

        Schema::table('tracks', function (Blueprint $table) {
            $table->integer('artist_id')->unsigned()->default(0);
        });
    }
}
