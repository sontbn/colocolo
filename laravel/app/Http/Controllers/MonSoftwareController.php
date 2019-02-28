<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class MonSoftwareController extends Controller
{
    protected $table = 'd_server';

    public function index()
    {
    	$where="";
        if(isset($_GET['center']) && $_GET['center']!==null){
            $where=" where a.center_id=".$_GET['center']." ";
        }
        $query = DB::select("
    		select 	a.id,
                    CONCAT(b.nama,' ',c.nm_env) AS nama_app,
                    a.fungsi,
                    a.serial_num,
                    a.tipe,
                    a.rak,
                    a.os_version,
                    a.cpu,
                    a.memory,
                    a.disk
    		from d_server a
            left outer join t_app b ON(a.app_id=b.id)
            left outer join r_env c ON(a.kd_env=c.kd_env)
            ".$where."
            order by a.id
    	");
    	$query=collect($query);

    	$datatables = Datatables::of($query)
    		->addIndexColumn()
    		->make(true);

    	return $datatables;
    }
}
