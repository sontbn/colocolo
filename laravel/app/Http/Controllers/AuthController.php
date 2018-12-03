<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class AuthController extends Controller
{
    public function index()
	{
		try{
			$query = DB::select("
				SELECT	*
				FROM r_app_version
				WHERE status='1'
			");
			
			return view('auth.login', [
				'app_versi' => $query[0]->versi,
				'app_nama'	=> $query[0]->nama,
				'app_ket'	=> $query[0]->ket
			]);
		}
		catch(\Exception $e){
			return $e->getMessage();
			//return 'Terdapat kesalahan! Hubungi Admin!';
		}
	}

	public function login(Request $request)
	{
		try{
			$username = $request->input('username');
			$password = $request->input('password');
			
			if($username!='' && $password!=''){
				
				$query = DB::select("
					SELECT	a.id,
							a.password,
							a.nama,
							a.foto,
							a.aktif,
							a.kdlevel,
							b.nmlevel,
							ifnull(a.email, '-') AS email,
							d.versi AS app_versi,
							d.nama AS app_nama,
							d.ket AS app_ket
					FROM t_user a
					LEFT OUTER JOIN r_level b ON(a.kdlevel=b.kdlevel),
					(
						SELECT	*
						FROM r_app_version
						WHERE status='1'
					) d
					WHERE a.username=?
				",[
					$username
				]);
				
				if(isset($query[0]) && $query[0]->password){
				
					if($query[0]->password==md5($password)){
					
						if($query[0]->aktif=='1'){
						
							session([
								'authenticated' => true,
								'user_id' => $query[0]->id,
								'username' => $username,
								'nama' => $query[0]->nama,
								'kdlevel' => $query[0]->kdlevel,
								'nmlevel' => $query[0]->nmlevel,
								'foto' => $query[0]->foto,
								'email' => $query[0]->email,
								'app_versi' => $query[0]->app_versi,
								'app_nama' => $query[0]->app_nama,
								'app_ket' => $query[0]->app_ket
							]);

							return response()->json(['error' => false,'message' => 'Login berhasil!']);
						}
						else{
							return response()->json(['error' => true,'message' => 'User tidak aktif!']);
						}
					}
					else{
						return response()->json(['error' => true,'message' => 'Password salah!']);
					}
				}
				else{
					return response()->json(['error' => true,'message' => 'User tidak terdaftar!']);
				}
			}
			else{
				return response()->json(['error' => true,'message' => 'Parameter tidak valid!']);
			}
		}
		catch(\Exception $e){
			return $e->getMessage();
			//return response()->json(['error' => true,'message' => 'Terdapat kesalahan lainnya!'], 503);
		}
	}

	public function logout()
	{
		Session::flush();
		return redirect()->guest('/');
	}
}
