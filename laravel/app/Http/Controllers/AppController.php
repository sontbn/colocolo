<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AppController extends Controller
{
    public function index()
    {
    	$menus = DB::select("
			SELECT a.*
			FROM t_menu a
			LEFT OUTER JOIN t_menu_level b ON(a.id=b.menu_id)
			WHERE a.aktif = '1'
			  AND a.parent_id = 0
			  AND b.kdlevel = ?
			ORDER BY a.nourut
		",[
			session('kdlevel')
		]);

		$html_out='';

		$angular = 'var app = angular.module("spa", ["ui.router","chieffancypants.loadingBar"]);
					app.config(function($stateProvider, $urlRouterProvider){
						$urlRouterProvider.otherwise("/");
						$stateProvider
						.state("/", {
							url: "/",
							templateUrl: "partials/dashboard.html"
						})';

		foreach($menus as $menu) {
			
			//jika is_parent == '0', tidak perlu buat sub menu
			if($menu->is_parent == '0'){
				
				$html_out .= '<li class="nav-item">
				             	<a class="nav-link" ui-sref="'.$menu->url.'">
				                	<i class="nav-icon '.$menu->icon.'"></i> '.$menu->title.'
				              	</a>
				            </li>';
				$angular .= '.state("'.$menu->url.'", {
								url: "/'.$menu->url.'",
								templateUrl: "partials/'.$menu->nmfile.'"
							})';
			}
			
			//jika is_parent != 0, perlu buat sub menu dengan parameter parent_id ybs
			else{
				$html_out .= '<li class="nav-item nav-dropdown">
						      	<a class="nav-link nav-dropdown-toggle" href="#">
							        <i class="nav-icon '.$menu->icon.'"></i> '.$menu->title.'
							    </a>
							    <ul class="nav-dropdown-items">';
				
				$sub_menus = DB::select("
					SELECT a.*
					FROM t_menu a
					LEFT OUTER JOIN t_menu_level b ON(a.id=b.menu_id)
					WHERE a.aktif='1'
					  AND b.kdlevel = ?
					  AND a.parent_id = ?
					ORDER BY a.nourut
				",[
					session('kdlevel'),
					$menu->id
				]);
				
				//bentuk sub menu
				foreach($sub_menus as $sub_menu){
					
					if($sub_menu->new_tab == null){
						$html_out .= '<li class="nav-item">
						                <a class="nav-link" ui-sref="'.$sub_menu->url.'">
						                    <i class="nav-icon '.$sub_menu->icon.'"></i> '.$sub_menu->title.'
						                </a>
						            </li>';
						$angular .= '.state("'.$sub_menu->url.'", {
										url: "/'.$sub_menu->url.'",
										templateUrl: "partials/'.$sub_menu->nmfile.'"
									})';
					}
					else{
						$html_out .= '<li>
										<a href="'.$sub_menu->url.'" target="_blank">'.$sub_menu->title.'</a>
									</li>';
					}
				}
				
				$html_out .= '	</ul>
							</li>';
			}
		}

		$angular .= '});';
		
		return view('app',
			[
				'menu' => $html_out,
				'angular' => $angular,
				'info_nmkantor' => session('nmsatker'),
				'info_nmlevel' => session('nmlevel'),
				'info_foto' => session('foto'),
				'info_nama' => session('nama'),
				'info_tahun' => session('tahun')
			]
		);
    }

    public function token()
    {
    	return csrf_token();
    }
}
