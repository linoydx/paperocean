<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Book;

class BookdesController extends Controller
{
	 /**
     * 检查图书描述是否添加
     * @param  [type] $book_id [description]
     * @return [type] status    [是否添加的状态码，0表示已添加，1表示未添加]
     */
    public function checkBookDes($book_id)
    {
        $book_info_id = DB::table('book_description')->where('book_id',$book_id)->value('id');
        if ($book_info_id != null) {
            $data = [ 'status' => 0 ];
            return $data;
        } else {
            $data = [ 'status' => 1 ];
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($book_id)
    {
        $book_name = Book::where('id',$book_id)->value('book_name');
        $data = [
            'book_id'   => $book_id,
            'book_name' => $book_name
        ];
        return view('admin.bookdes.add')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $input = $request->input();
        dd($input);
        $res = DB::table('book_info')->insert($input);
        if ($res) {
            return redirect()->Route('bookinfo.show')->with('msg','添加图书信息成功！');
        } else {
            return back()->with($input)->with('msg','添加图书信息失败...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($book_id)
    {
        $book_info = DB::table('book_info')->where('book_id',$book_id)->first();
        $book_info->book_name = DB::table('book')->where('id',$book_id)->value('book_name');
        // dd($book_info);
        return view('admin.bookinfo.info')->with('data',$book_info);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book_info = DB::table('book_info')->where('id',$id)->first();
        $book_info->book_name = DB::table('book')->where('id',$book_info->book_id)->value('book_name');
        return view('admin.bookinfo.edit')->with('data',$book_info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_method','_token');
        $res = DB::table('book_info')->where('id',$id)->update($input);
        // dd($res);
        if ($res) {
            return true;
        } else {
            return back()->with($input)->with('msg','修改失败');
        }
        
    }
}