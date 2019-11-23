<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Book;

class BookinfoController extends Controller
{
    /**
     * 检查图书信息是否添加
     * @param  [type] $book_id [description]
     * @return [type] status    [是否添加的状态码，0表示已添加，1表示未添加]
     */
    public function checkBookInfo($book_id)
    {
        $book_info_id = DB::table('book_info')->where('book_id',$book_id)->value('id');
        if ($book_info_id != null) {
            $data = [ 'status' => 0 ];
            return $data;
        } else {
            $data = [ 'status' => 1 ];
        }
        
    }
    /**
     * 详细信息添加页
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function create($book_id)
    {
        $book_name = Book::where('id',$book_id)->value('book_name');
        $data = [
            'book_id'   => $book_id,
            'book_name' => $book_name
        ];
        return view('admin.bookinfo.add')->with('data',$data);
    }

    /**
     * 图书详细信息存库
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
         $rules = [
          'book_writer' => 'bail|required',
          'book_publisher' => 'required',
          'book_ISBN' => 'required|numeric',
          'book_format' => 'required|numeric',
          'book_page_num' => 'required|numeric',
        ];
        $messages = [
          'book_writer.required' => '作者不能为空！',
          'book_publisher.required' => '出版商不能为空',
          'book_ISBN.required' => 'ISBN不能为空！',
          'book_ISBN.numeric' => 'ISBN必须是数字！',
          'book_format.required' => '开本不能为空！',
          'book_format.numeric' => '开本必须是数字！',
          'book_page_num.required' => '页数不能为空！',
          'book_page_num.numeric' => '页数必须是数字！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
        $input = $request->except('_token');
        dd($input);
        $res = DB::table('book_info')->insert($input);
        if ($res) {
            return redirect()->Route('bookinfo.show')->with('msg','添加图书信息成功！');
        } else {
            return back()->with($input)->with('msg','添加图书信息失败...');
        }
    }

    /**
     * 图书详细信息展示     
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function show($book_id)
    {
        $book_info = DB::table('book_info')->where('book_id',$book_id)->first();
        $book_info->book_description = htmlspecialchars_decode($book_info->book_description);
        $book_info->book_name = DB::table('book')->where('id',$book_id)->value('book_name');
        // dd($book_info);
        return view('admin.bookinfo.info')->with('data',$book_info);
    }

    /**
     * 编辑图书详细信息
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $book_info = DB::table('book_info')->where('id',$id)->first();
        $book_info->book_name = DB::table('book')->where('id',$book_info->book_id)->value('book_name');
        return view('admin.bookinfo.edit')->with('data',$book_info);
    }

    /**
     * 更新图书详细信息
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $input = $request->except('_method','_token');
        $input['book_description'] = htmlspecialchars($input['book_description']);
        // dd($input);
        $res = DB::table('book_info')->where('id',$id)->update($input);
        if ($res) {
            return '111';
        } else {
            return back()->with($input)->with('msg','修改失败');
        } 
    }
}
