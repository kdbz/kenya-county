<?php
namespace Kdbz\KenyaCounty\Imports;

use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Facades\DB;
use Kdbz\KenyaCounty\KenyaCounty;

class KCounty implements OnEachRow
{
    
    public $counties = [];
    public $subcounty = [];
    public $towns = [];
    
    /**
     * row
     *
     * @param  mixed $row
     * @return void
     */
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        
        //county
        $county = $row[0];
        if(is_string($county) && $county != null  && $county != "")
            $this->countyCheck($county);
        
        $county_id = $row[1];

        //subcounty
        $subcounty = $row[2];
        if(is_string($subcounty) && $subcounty != null && $subcounty != "")
            $this->subCountyCheck($county_id,$subcounty);

        //towns/wards
        $sc_name = $row[2];
        $ward = $row[3];

        $this->insertWard($sc_name,$ward);

        //done :)
        
    }    
    /**
     * countyCheck
     *
     * @param  mixed $county
     * @return void
     */
    public function countyCheck($county){
        $county = strtolower($county);
        $county_table = KenyaCounty::getCountyTable();
        $result = DB::table($county_table)->where('name',$county)->select('id')->get();
        if($result->isEmpty())
           $id = DB::table($county_table)->insertGetId(['name' => $county,'created_at'=>date('Y-m-d H:i:s', time())]);
        else
            $id = $result->first()->id;
        
        return $id;
    }    
    /**
     * subCountyCheck
     *
     * @param  mixed $county_id
     * @param  mixed $scounty
     * @return void
     */
    public function subCountyCheck($county_id,$scounty){
        $scounty = strtolower($scounty);
        $subcounty_table = KenyaCounty::getSubCountyTable();
        $result = DB::table($subcounty_table)->where('name',$scounty)->select('id')->get();
        
        if($result->isEmpty())
           $id = DB::table($subcounty_table)->insertGetId(['name' => $scounty,'county_id'=>$county_id,'created_at'=>date('Y-m-d H:i:s', time())]);
        else
          $id = $result->first()->id;
        
        return $id;
    }
        
    /**
     * getSubCountyId
     *
     * @param  mixed $sc_name
     * @return void
     */
    public function getSubCountyId($sc_name){
        $sc_name = strtolower($sc_name);
        $subcounty_table = KenyaCounty::getSubCountyTable();
        $result = DB::table($subcounty_table)->select('id')->where('name',$sc_name)->get();
        return $result->first()->id;
    }

    /**
     * wardCheck
     *
     * @param  mixed $sc_name
     * @param  mixed $ward
     * @return void
     */
    public function insertWard($sc_name,$ward){
        $ward=strtolower($ward);
        $sc_name=strtolower($sc_name);
        $ward_table = KenyaCounty::getWardTable();
        
        $sc_id = $this->getSubCountyId($sc_name);
        //insert
        DB::table($ward_table)->insert(['name' => $ward,'sc_id'=>$sc_id,'created_at'=>date('Y-m-d H:i:s', time())]);
    }

    public static function test(){
        echo 'accessed!';
    }
}