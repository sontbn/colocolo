<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class MonAdministrativeController extends Controller
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
                    d.nama as nm_uakpb,
                    a.kd_bmn,
                    e.uraian,
                    a.kondisi,
                    f.nm_sts,
                    a.ket
    		from d_server a
            left outer join t_app b ON(a.app_id=b.id)
            left outer join r_env c ON(a.kd_env=c.kd_env)
            left outer join t_uakpb d ON(a.uakpb_id=d.id)
            left outer join r_uraian_bmn e ON(a.uraian_bmn_id=e.id)
            left outer join r_lisensi_sts f ON(a.kd_sts_lisensi=f.kd_sts)
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
