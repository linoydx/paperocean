<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //图书相册模型
    protected $table = 'book_picture';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
}
