<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class MonHardwareController extends Controller
{
    protected $table = 'd_server';

    public function index()
    {
    	$where="";
        if(isset($_GET['center']) && $_GET['center']!==null){
            $where=" where center_id=".$_GET['center']." ";
        }
        $query = DB::select("
    		select 	a.id,
    				b.nama as nama_app,
    				c.nm_env,
                    a.fungsi,
                    a.serial_num,
                    d.nama as nama_merk,
                    a.tipe,
                    a.ip,
                    a.hostname,
                    e.nama as nama_center,
                    a.rak
    		from d_server a
            left outer join t_app b ON(a.app_id=b.id)
            left outer join r_env c ON(a.kd_env=c.kd_env)
            left outer join t_merk d ON(a.merk_id=d.id)
            left outer join r_center e ON(a.center_id=e.id)
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
