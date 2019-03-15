<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class InputController extends Controller
{
    protected $table = 'd_server';

    public function index()
    {
    	$and="";
    	if(isset($_GET['app']) && $_GET['app']!=="") {
    		$and.=" and a.app_id=".$_GET['app']." ";
        }
        if(isset($_GET['env']) && $_GET['env']!=="") {
        	$and.=" and a.kd_env=".$_GET['env']." ";
        }
        if(isset($_GET['center']) && $_GET['center']!=="") {
        	$and.=" and a.center_id=".$_GET['center']." ";
        }

    	$query = DB::select("
    		select 	a.id,
    				CONCAT(b.nama,' ',c.nm_env) AS nama_app,
    				a.fungsi,
    				a.serial_num,
    				a.ip,
    				CONCAT(d.nama,' rak ',a.rak) AS lokasi,
    				a.kondisi
    		from ".$this->table." a
    		left outer join t_app b on(a.app_id=b.id)
    		left outer join r_env c on(a.kd_env=c.kd_env)
    		left outer join r_center d on(a.center_id=d.id)
    		where a.id is not null
    		  ".$and."
    		order by id desc
    	");
    	$query=collect($query);

    	$datatables = Datatables::of($query)
    		->addIndexColumn()
    		->addColumn('action', function($row){
    			return view('action.server', [
    				'id'=>$row->id
    			]);
    		})
    		->make(true);

    	return $datatables;
    }

    public function store(Request $request)
    {
    	try {
    		$insert = DB::table($this->table)->insert([
    			'serial_num'=>$request->input('serial_num'),
    			'app_id'=>$request->input('app_form'),
    			'kd_env'=>$request->input('env_form'),
    			'fungsi'=>$request->input('fungsi'),
    			'merk_id'=>$request->input('merk_form'),
    			'tipe'=>$request->input('tipe'),
    			'ip'=>$request->input('ip'),
    			'hostname'=>$request->input('hostname'),
    			'center_id'=>$request->input('center_form'),
    			'rak'=>$request->input('rak'),
    		]);

    		if($insert){
    			return 'success';
    		}
    		else{
    			return 'Data gagal disimpan!';
    		}
    	} catch (\Exception $e) {
    		//return $e->getMessage();
    		return 'Terjadi kesalahan. Hubungi Admin!';
    	}
    }

    public function edit($id)
    {
    	$query = DB::table($this->table)->where('id',$id)->get();

    	return json_encode($query[0]);
    }

    public function update(Request $request)
    {
    	try {
    		$update = DB::table($this->table)
    			->where('id', $request->input('inp-id'))
    			->update([
    				'serial_num'=>$request->input('serial_num'),
	    			'app_id'=>$request->input('app_form'),
	    			'kd_env'=>$request->input('env_form'),
	    			'fungsi'=>$request->input('fungsi'),
	    			'merk_id'=>$request->input('merk_form'),
	    			'tipe'=>$request->input('tipe'),
	    			'ip'=>$request->input('ip'),
	    			'hostname'=>$request->input('hostname'),
	    			'center_id'=>$request->input('center_form'),
	    			'rak'=>$request->input('rak'),
    			]);

    		if($update){
    			return 'success';
    		}
    		else{
    			return 'Data gagal diubah!';
    		}
    	} catch (\Exception $e) {
    		//return $e->getMessage();
    		return 'Terjadi kesalahan. Hubungi Admin!';
    	}
    }

    public function destroy(Request $request)
    {
    	try {
    		$delete = DB::table($this->table)
    			->where('id', $request->input('id'))
    			->delete();

    		if($delete){
    			return 'success';
    		}
    		else{
    			return 'Data gagal dihapus!';
    		}
    	} catch (\Exception $e) {
    		//return $e->getMessage();
    		return 'Terjadi kesalahan. Hubungi Admin!';
    	}
    }
}
