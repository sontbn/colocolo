<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class RefMerkController extends Controller
{
    protected $table = 't_merk';

    public function index()
    {
    	$query = DB::select("
    		SELECT 	id,
    				nama,
    				ifnull(ket,'-') as ket
    		FROM t_merk
    	");
    	$query=collect($query);

    	$datatables = Datatables::of($query)
    		->addIndexColumn()
    		->addColumn('action', function($row){
    			return view('action.general', [
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
    			'nama'=>$request->input('nama'),
    			'ket'=>$request->input('ket')
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
    	$query = DB::select("SELECT * FROM t_merk WHERE id=?", [$id]);

    	return json_encode($query[0]);
    }

    public function update(Request $request)
    {
    	try {
    		$update = DB::table($this->table)
    			->where('id', $request->input('inp-id'))
    			->update([
    				'ket'=>$request->input('ket')
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
    			return 'Data gagal diubah!';
    		}
    	} catch (\Exception $e) {
    		//return $e->getMessage();
    		return 'Terjadi kesalahan. Hubungi Admin!';
    	}
    }
}
