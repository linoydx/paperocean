<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Index\CommenController;
use Illuminate\Support\Facades\DB;

class UserShipinfoController extends CommenController
{
	public function index()
	{
		$user_id = session('user_id');
		DB::table('user_shipinfo')->where('user_id',$user_id)->get();
	}
	public function create(Request $request)
	{
		if ($request->isMethod('post')) {
			$user_id = session('user_id');
		}
	}
	public function update()
	{

	}
	public function delete()
	{

	}
}