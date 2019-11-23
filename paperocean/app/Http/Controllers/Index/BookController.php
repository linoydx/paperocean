<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Index\CommenController;
use Illuminate\Support\Facades\DB;

class BookController extends CommenController
{
    public function index() {
        
    }
    /**
     * 显示id为$id的图书信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $book_id = (int)$id;
        // dd($book_id);
    	$data['book'] = DB::table('book')
    			->join('book_info','book.id','=','book_info.book_id')
    			->select('book.id','book.book_name','book.book_title','book.book_number','book.guide_price','book.shop_price','book_info.book_writer','book_info.book_publisher','book_info.book_ISBN','book_info.book_format','book_info.book_words_num','book_info.book_page_num','book_info.book_publication_data','book_info.book_print_data','book_info.book_description')
    			->where('book.id',$book_id)
    			->first();
        // dd($data);
        if (is_null($data['book'])) {
            echo '图书已下架';
        } else {
            $data['book']->book_description = htmlspecialchars_decode($data['book']->book_description);
            $data['book_pic'] = DB::table('book_picture')->where('book_id',$book_id)->select('pic')->get()->toArray();
            // dd($data);
            return view('index.book')->with('data',$data);
        }  
    }
}