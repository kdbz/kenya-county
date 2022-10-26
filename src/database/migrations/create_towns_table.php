<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kdbz\KenyaCounty\KenyaCounty;

class CreateWardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //drop if exists
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(KenyaCounty::getWardTable());
        Schema::enableForeignKeyConstraints();

        Schema::create(KenyaCounty::getWardTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',200);
            $table->text('lat_long')->nullable();
            $table->unsignedInteger('sc_id');
            $table->timestamps();

            $table->foreign('sc_id')->references('id')->on('subcounty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(KenyaCounty::getWardTable());
    }
}
