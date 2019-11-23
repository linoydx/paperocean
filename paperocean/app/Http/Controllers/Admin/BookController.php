<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Book;
use App\Http\Models\Category;

class BookController extends Controller
{
  // get.book.index图书列表页
  public function index()
    {
      $books = Book::paginate(2);
      foreach ($books as  $book) {
    	 $cate = Category::find($book->cate_id);
    	 $book->cate_name = $cate->cate_name;
      }
      // dd($books);
      return view('admin.book.lst')->with('data',$books);
    }
    
    // get.book.create图书添加页
    public function create()
    {
    	$cates = Category::where('pid',0)->get();
    	return view('admin.book.add')->with('data',$cates);
    	
    }
    
    // 上传book图片
    public function uploadPic($files)
    {
        static $filepath = array();
        $url_path = "public/uploads/books";
        foreach ($files as $file) {
            if($file->isValid()) {
                $filename = $file->getClientOriginalName();
                // $extension = $file -> getClientOriginalExtension();
                // $mimeType = $file -> getMimeType();
                $newFilename = md5(date("YmdHis")).$filename;
                $file -> move($url_path,$newFilename);
                $filepath[] = $url_path.'/'.$newFilename;
            }
        }  
        return $filepath;
    }
    // post.book.store添加图书
    public function store(Request $request)
    {
        $rules = [
          'book_name' => 'bail|required|max:10|unique:book',
          'book_pic' => 'required',
          'book_title' => 'required',
          'book_number' => 'required|numeric',
          'guide_price' => 'required',
          'shop_price' => 'required',
        ];
        $messages = [
          'book_name.required' => '图书名称不能为空！',
          'book_name.max' => '图书名称不能超过10个字符',
          'book_name.unique' => '图书名称已存在！',
          'book_pic.required' => '图书图片不能为空！',
          'book_title.required' => '图书推荐不能为空！',
          'book_number.required' => '图书数量不能为空！',
          'book_number.numeric' => '图书数量必须是数字！',
          'guide_price.required' => '图书指导价格不能为空！',
          'shop_price.required' => '图书指导价格不能为空！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
        $input = $request->except('_token','pcate_id','book_pic');
        // dd($input);
        $book = Book::create($input);
        if ($book) {
            $files = $request->file('book_pic');
            $path = $this->uploadPic($files);
            foreach ($path as $v) {
                $data[] = [
                    'pic' => $v,
                    'book_id' => $book->id,
                ];
            }
            $res = DB::table('book_picture')->insert($data);
            if ($res) {
                return redirect()->action('Admin\BookController@show')->with('msg','添加图书成功！');
            } else {
                return redirect()->action('Admin\BookController@show',['id'=>$book->id])->with('msg','添加图书成功！图片上传失败...');
            }
            
        } else {
            return back()->with('msg','添加图书失败，请稍后重试...');
        }
    }
    // get.book.show单个图书信息
    public function show($id)
    {
    	$data['book'] = Book::find($id);
        $data['book_pic'] = DB::table('book_picture')->where('book_id',$id)->get();
    	$cate = new Category();
    	$data['cate'] = $cate->getCate($data['book']->cate_id);
    	// dd($data);
    	return view('admin.book.details')->with('data',$data);
    }
    // get.book.edit修改页面
    public function edit($id)
    {

        $data['book'] = Book::find($id);
        $cate = new Category();
        $data['cate'] = $cate->getcate($data['book']->cate_id);
        // dd($data);
        return view('admin.book.edit')->with('data',$data); 
    }
    // put.book.update图书更新
    public function update($id,Request $request)
    {
        $rules = [
          'book_name' => 'bail|required|max:10',
          'description' => 'required',
          'recommended' => 'required',
          'book_number' => 'required|numeric',
          'guide_price' => 'required',
          'shop_price' => 'required',
        ];
        $messages = [
          'book_name.required' => '图书名称不能为空！',
          'book_name.max' => '图书名称不能超过10个字符',
          'description.required' => '图书描述不能为空！',
          'recommended.required' => '图书推荐不能为空！',
          'book_number.required' => '图书数量不能为空！',
          'book_number.numeric' => '图书数量必须是数字！',
          'guide_price.required' => '图书指导价格不能为空！',
          'shop_price.required' => '图书指导价格不能为空！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
    	$input = $request->except('_token','pcate_id','_method');
        // dd($input);
        $book = Book::find($id);
        if($book->update($input)){
            return redirect()->action('Admin\BookController@show',['id'=>$id])->with('msg','更新图书成功');
        } else {
            return back()->with('msg','更新图书失败，请稍后重试...');
        }
    }
    // delete.book.destroy图书删除
    public function destroy($id)
    {
    	$res = Book::destroy($id);
        $re = DB::table('book_picture')->where('book_id',$id)->delete();
    	if ($res&&$re) {
    		$data = [
       				'status' => 0,
       				'msg'    => '删除图书成功！'
       			];
    	} else {
    		$data = [
       				'status' => 1,
       				'msg'    => '删除图书失败，请稍后再试...'
       			];
    	}
    	return $data;
    }
    // 显示book描述
    public function showDes($book_id,Request $request)
    {
      return view('admin.book.des');
    }
    // 显示book_info
    public function showInfo($book_id)
    {
      $book = DB::table('book_info')->where('book_id',$book_id)->get();
      $book->book_name = Book::where('id',$book_id)->value('book_name');
      dd($book);
      return view('admin.book.info');
    }
}
