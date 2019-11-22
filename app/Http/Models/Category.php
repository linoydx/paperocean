<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //图书分类模型
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    // 获取树状分类
    public function getCates()
    {
    	$cates = Category::all()->toArray();
    	// dd($cates);
    	return $this->getTree($cates);
    }

    // 获取树状图
    private function getTree($data,$pid = 0,$level = 0)
    {
    	static $res = array();
    	foreach ($data as $k => $v) {
    		if ($v['pid'] == $pid) {
    			$v['level'] = $level;
    			$res[] = $v;
    			$this->getTree($data,$v['id'],$level+1);    		
    		}
    	}
    	return $res;
    }

    public function getChildren()
    {
        # code...
    }

    // 获取某个分类
    public function getCate($id)
    {
        $data = array();
        while ( $id != 0) {
            $cate = Category::find($id);
            $id = $cate->pid;
            $data[] = $cate;
        }
        return $data;
    }
}
