@extends('layout.app')
@section('title')
    Logout
@endsection
@section('content')
    <div class="h2">Logout</div>
    <hr>
    <header>
        <h1>Logout</h1>
        @auth
            <form method="POST" action="{{ route('admin.dashboard') }}">
                @csrf
                <button type="submit">Çykmak</button>
            </form>
        @endauth
    </header>
@endsection
