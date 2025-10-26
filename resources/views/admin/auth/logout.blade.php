@extends('layout.app')
@section('title')
    Logout
@endsection
@section('content')
    <div class="h2">Logout</div>
    <hr>
    <header>
        <h1>Админ-панель</h1>
        @auth
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit">Выйти</button>
            </form>
        @endauth
    </header>
@endsection
