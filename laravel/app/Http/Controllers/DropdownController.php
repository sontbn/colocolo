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

        $html_out = '<option value="" style="display:none;">Pilih Center</option>';
        foreach ($query as $row) {
            $html_out .= '<option value="'.$row->id.'">'.$row->nama.'</option>';
        }

    	echo $html_out;
    }
}
