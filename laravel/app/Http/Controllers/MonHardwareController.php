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
            $where=" where a.center_id=".$_GET['center']." ";
        }
        $query = DB::select("
    		select 	a.id,
                    b.nama AS nama_app,
                    c.nm_env,
                    c.warna,
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
    	$rows=collect($query);

    	$datatables = Datatables::of($rows)
    		->addIndexColumn()
            ->addColumn('app',function($row){
                $app = $row->nama_app.' '.$row->nm_env;
                return $app;
            })
    		->make(true);

    	return $datatables;
    }
}
