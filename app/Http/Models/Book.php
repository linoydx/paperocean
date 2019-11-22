<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //图书模型
    protected $table = 'book';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
