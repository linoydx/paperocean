<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function index()
  {
  	$admin_id = session('admin_id');
  	$admin_pris = DB::table('privilege')
  		->leftJoin('role_pri','privilege.id','=','role_pri.pri_id')
  		->leftJoin('admin_role','role_pri.role_id','=','admin_role.role_id')
  		->where('admin_role.admin_id','=',$admin_id)
  		->get();
  		// dd($admin_pris);
  	foreach ($admin_pris as $value) {
  		if ($value->pid == 0) {
  			foreach ($admin_pris as $value2) {
  				if ($value->id == $value2->pid) {
  					$value->children[] = $value2;
  				}
  			}
  			$data[] = $value;
  		}
  	}
  	// dd($data);
  	return view('admin.index')->with('data',$data);
  }
}