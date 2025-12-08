@extends('client.layout.app')

@section('content')
    <div class="container py-5 text-center">
        <h3>Satyn alyndy!</h3>
        <p>Kitap: <strong>{{ $product->title }}</strong></p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Yza gaýt</a>
    </div>
@endsection
