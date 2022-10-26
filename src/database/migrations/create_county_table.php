<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kdbz\KenyaCounty\KenyaCounty;

class CreateCountyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //dropIfexists
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(KenyaCounty::getCountyTable());
        Schema::enableForeignKeyConstraints();
        
        Schema::create(KenyaCounty::getCountyTable(), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
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
        Schema::dropIfExists(KenyaCounty::getCountyTable());
    }
}
