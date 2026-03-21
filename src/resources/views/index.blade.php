@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="todo">

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
    <h2>新規作成</h2>
    <form class="form" action="/todos" method="POST">
        @csrf
        <input type="text" name="content" value="{{ old('content') }}">
        <select name="category_id">
            <option value="">カテゴリ</option>
        </select>
        <button>作成</button>
    </form>

    {{-- 検索 --}}
    <h2>検索</h2>
    <form class="form">
        <input type="text" name="keyword">
        <select name="category_id">
            <option value="">カテゴリ</option>
        </select>
        <button>検索</button>
    </form>

    {{-- 一覧 --}}
    <table class="table">
        <tr>
            <th>Todo</th>
            <th>カテゴリ</th>
            <th></th>
        </tr>

        @foreach ($todos as $todo)
        <tr>
            <td>
                <form action="/todos/update" method="POST" class="inline-form">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="content" value="{{ $todo['content'] }}">
                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
            </td>

            <td>
                {{ $todo->category->name ?? '' }}
            </td>

            <td>
                <button>更新</button>
                </form>

                <form action="/todos/delete" method="POST" class="inline-form">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $todo['id'] }}">
                    <button>削除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

</div>

@endsection