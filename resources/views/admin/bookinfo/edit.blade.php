@extends('layouts.admin.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/resources/org/kindeditor/themes/default/default.css') }}">
<link rel="stylesheet" href="{{ asset('/resources/org/kindeditor/plugins/code/prettify.css') }}">
<form name="main_form" method="POST" action="{{ url('bookinfo/'.$data->id) }}" enctype="multipart/form-data" >
    @method('PUT')
    {{csrf_field()}}
        <table cellspacing="1" cellpadding="3" width="100%">
            @if ($errors->any())
            <div class="alert alert-danger">
                 <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div>
                @if(session('msg'))
                <p>{{ session('msg') }}</p>
                 @endif
            </div>

            @if (!empty($data))
            <tr>
                <td class="label">图书名称：</td>
                <td>
                    <p>{{ $data->book_name }}</p>
                    <input type="hidden" name="book_id" value="{{ $data->book_id }}" required="required">
                </td>
            </tr>
                            
            @endif
            <tr>
                <td class="label">作者：</td>
                <td>
                    <input type="text" name="book_writer" value="{{ $data->book_writer }}" required="required">
                </td>
            </tr>
            <tr>
                <td class="label">出版商：</td>
                <td>
                    <input type="text" name="book_publisher" value="{{ $data->book_publisher }}" required="required">
                </td>
            </tr>
            <tr>
                <td class="label">ISBN：</td>
                <td>
                    <input type="text" name="book_ISBN" value="{{ $data->book_ISBN }}" required="required">
                </td>
            </tr>
            <tr>
                <td class="label">开本：</td>
                <td>
                    <input type="text" name="book_format" value="{{ $data->book_format }}" required="required">
                </td>
            </tr>
            <tr>
                <td class="label">字数：</td>
                <td>
                    <input type="text" name="book_words_num" value="{{ $data->book_words_num }}">字
                </td>
            </tr>
            <tr>
                <td class="label">页数：</td>
                <td>
                    <input type="text" name="book_page_num" value="{{ $data->book_page_num }}" required="required">页
                </td>
            </tr>
            <tr>
                <td class="label">出版日期：</td>
                <td>
                    <input type="text" name="book_publication_data" value="{{ $data->book_publication_data }}"><span>格式：1990-09-01</span>
                </td>
            </tr>
            <tr>
                <td class="label">印刷日期：</td>
                <td>
                    <input type="text" name="book_print_data" value="{{ $data->book_print_data }}"><span>格式：1990-09-01</span>
                </td>
            </tr>
            <tr>
                <td class="label">图书描述：</td>
                <td>
                    <textarea name="book_description" id="book_des"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 保存 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
    <script src="{{ asset('/resources/org/kindeditor/kindeditor-all-min.js') }}"></script>
    <script src="{{ asset('/resources/org/kindeditor/lang/zh-CN.js') }}"></script>
    <script src="{{ asset('/resources/org/kindeditor/plugins/code/prettify.js') }}"></script>
    <script>
        // 富文本编辑器
        KindEditor.ready(function(K) {
            window.editor = K.create('#book_des',{
                width: '1000px',
                height: 'auto',
                upload_json: "{{ asset('resources/org/php/upload_json.php') }}",
                fileManagerJson : "{{ asset('resources/org/php/fileManagerJson.php') }}",
                allowFileManager : true
            });
        });
    </script>
 @endsection  