<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	protected $table = 'admin';
	protected $primaryKey = 'id';
	public $timestamps = false;
	protected $guarded = [];

	public function roles() {
		return $this->belongsToMany('App\Http\Models\Role','admin_role','admin_id', 'role_id');
	}
}
