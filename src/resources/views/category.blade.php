@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')

<div class="category">

    {{-- メッセージ --}}
    @if (session('message'))
    <div class="alert success">{{ session('message') }}</div>
    @endif

    @if ($errors->any())
    <div class="alert danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 新規作成 --}}
    <form class="form" method="POST" action="/categories">
        @csrf
        <input type="text" name="name" value="{{old ('name')
    }}">
        <button>作成</button>
    </form>

    {{-- 一覧 --}}
    <table class="table">
        <tr>
            <th>Category</th>
            <th></th>
        </tr>

        @foreach ($categories as $category)
        <tr>
            <td>
                <form method="POST" action="/categories/update" class="update-form">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" value="{{ $category['name'] }}">
                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                    <button>更新</button>
                </form>
            </td>

            <td>


                <form method="POST" action="/categories/delete" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $category['id'] }}">
                    <button>削除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

</div>

@endsection