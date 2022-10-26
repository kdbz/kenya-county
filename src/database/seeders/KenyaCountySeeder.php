<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Kdbz\KenyaCounty\Imports\KCounty;
use Maatwebsite\Excel\Facades\Excel;
use Kdbz\KenyaCounty\KenyaCounty;

class KenyaCountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		//truncate existing table data
        DB::table(KenyaCounty::getCountyTable())->truncate();
        DB::table(KenyaCounty::getSubCountyTable())->truncate();
        DB::table(KenyaCounty::getWardTable())->truncate();

        Excel::import(new KCounty, __DIR__.'/data.xlsx');

        //reset foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

   
}
