<?php
namespace Kdbz\KenyaCounty;
use Kdbz\KenyaCounty\Imports\KCounty;

class KenyaCounty{

    public function test(){
        return KCounty::test();
    }

    public static function getCountyTable(){
        return config('kenyacounty.county_table');
    }

    public static function getSubCountyTable(){
        return config('kenyacounty.subcounty_table');
    }

    public static function getWardTable(){
        return config('kenyacounty.ward_table');
    }
}