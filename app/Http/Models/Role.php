<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    public function admins()
    {
        return $this->belongsToMany('App\Http\Models\Admin','admin_role','role_id','admin_id');
    }

    public function pris()
    {
    	return $this->belongsToMany('App\Http\Models\Privilege','role_pri','role_id','pri_id');
    }
}
