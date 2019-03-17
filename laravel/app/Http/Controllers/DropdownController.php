<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class DropdownController extends Controller
{
    public function center()
    {
    	$query = DB::select("SELECT * FROM r_center");

        $html_out = '
        	<option value="" style="display:none;">Pilih Data Center</option>
            <option value="" style="font-weight:bold;">Semua</option>
        ';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

    	echo $html_out;
    }
    public function center_form()
    {
        $query = DB::table('r_center')->get();

        $html_out = '<option value="" style="display:none;">Pilih Data Center</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

        echo $html_out;
    }

    public function app()
    {
        $query = DB::table('t_app')->get();

        $html_out = '
            <option value="" style="display:none;">Pilih App/DB/Data</option>
            <option value="" style="font-weight:bold;">Semua</option>
        ';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

        echo $html_out;
    }
    public function app_form()
    {
        $query = DB::table('t_app')->get();

        $html_out = '<option value="" style="display:none;">Pilih App/DB/Data</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

        echo $html_out;
    }

    public function env()
    {
        $query = DB::table('r_env')->get();

        $html_out = '
            <option value="" style="display:none;">Pilih Env</option>
            <option value="" style="font-weight:bold;">Semua</option>
        ';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->kd_env.'">'.$row->nm_env.'</option>';
        }

        echo $html_out;
    }
    public function env_form()
    {
        $query = DB::table('r_env')->get();

        $html_out = '<option value="" style="display:none;">Pilih Env</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->kd_env.'">'.$row->nm_env.'</option>';
        }

        echo $html_out;
    }

    public function merk_form()
    {
        $query = DB::table('t_merk')->get();

        $html_out = '<option value="" style="display:none;">Pilih Merk</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

        echo $html_out;
    }

    public function os_form()
    {
        $query = DB::table('t_os')->get();

        $html_out = '<option value="" style="display:none;">Pilih OS</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

        echo $html_out;
    }

    public function uakpb_form()
    {
        $query = DB::table('t_uakpb')->get();

        $html_out = '<option value="" style="display:none;">Pilih UAKPB</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

        echo $html_out;
    }

    public function uraianbmn_form()
    {
        $query = DB::table('r_uraian_bmn')->get();

        $html_out = '<option value="" style="display:none;">Uraian BMN</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->uraian.'</option>';
        }

        echo $html_out;
    }

    public function stslisensi_form()
    {
        $query = DB::table('r_lisensi_sts')->get();

        $html_out = '<option value="" style="display:none;">Pilih Status</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->kd_sts.'">'.$row->nm_sts.'</option>';
        }

        echo $html_out;
    }
}
