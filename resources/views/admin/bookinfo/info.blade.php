@extends('layouts.admin.app')

@section('content')
<div>
    @if(session('msg'))
        <p>{{ session('msg') }}</p>
    @endif
</div>
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

    @if (!empty($data))               
    <tr>
        <td class="label">图书名称：</td>
        <td>
            {{ $data->book_name }}
        </td>
    </tr>

    <tr>
        <td class="label">作者：</td>
        <td>
            {{ $data->book_writer }}
        </td>
    </tr>

    <tr>
        <td class="label">出版商：</td>
        <td>
            {{ $data->book_publisher }}
        </td>
    </tr>
    <tr>
        <td class="label">ISBN：</td>
        <td>
            {{ $data->book_ISBN }}
        </td>
    </tr>
    <tr>
        <td class="label">开本：</td>
        <td>
            {{ $data->book_format }}开
        </td>
    </tr>
            
    <tr>
        <td class="label">字数：</td>
        <td>
            {{ $data->book_words_num }}字
        </td>
    </tr>

    <tr>
        <td class="label">页数：</td>
        <td>
            {{ $data->book_page_num }}页
        </td>
    </tr>

    <tr>
        <td class="label">出版日期：</td>
        <td>
            {{ $data->book_publication_data }}
        </td>
    </tr>
    <tr>
        <td class="label">印刷日期：</td>
        <td>
            {{ $data->book_print_data }}
        </td>
    </tr>
    <style>
        #book_des img {
            -webkit-border:0;
        }
    </style>
    <tr>
        <td class="label">图书描述：</td>
        <td id="book_des">
            {!! $data->book_description !!}
        </td>
    </tr>
    <tr>
        <td class="label">操作：</td>
        <td>
            <a href="{{ url('bookinfo/'.$data->id.'/edit') }}">修改</a>
        </td>
    </tr>
    @endif
</table>
 @endsection 