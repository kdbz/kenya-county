<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kdbz\KenyaCounty\KenyaCounty;
class CreateSubcountyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //drop ifexists
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(KenyaCounty::getSubCountyTable());
        Schema::enableForeignKeyConstraints();

        Schema::create(KenyaCounty::getSubCountyTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->unsignedInteger('county_id');
            $table->timestamps();

            $table->foreign('county_id')->references('id')->on('county');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(KenyaCounty::getSubCountyTable());
    }
}
