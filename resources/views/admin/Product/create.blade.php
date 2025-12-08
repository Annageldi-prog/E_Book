@extends('client.layout.app')
@section('content')
    <h1>Kitaplar</h1>
    <div class="mb-3">
        <label for="image" class="form-label">Surat (Image)</label>
        <input type="file" class="form-control" name="image" id="image" accept="image/*">
    </div>
@endsection
