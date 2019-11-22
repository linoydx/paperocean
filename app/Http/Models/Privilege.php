<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    //权限模型
    protected $table = 'privilege';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function roles()
    {
    	return $this->belongsToMany('App\Http\Models\Role','role_pri','pri_id','role_id');
    }
}