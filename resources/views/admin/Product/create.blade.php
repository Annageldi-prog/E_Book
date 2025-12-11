@extends('admin.layout.admin')

@section('title', 'Add New Product')

@section('content')
    <div class="container-lg py-4">

        <h2 class="text-warning mb-4 fw-bold">Add New Product</h2>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
              class="bg-dark p-4 rounded shadow form-box">
            @csrf

            {{-- Product Title --}}
            <div class="mb-3">
                <label for="name" class="form-label text-light">Product Name</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label text-light">Category</label>
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Author --}}
            <div class="mb-3">
                <label for="author_id" class="form-label text-light">Author</label>
                <select name="author_id" id="author_id" class="form-select" required>
                    <option value="">Select author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Series --}}
            <div class="mb-3">
                <label for="series_id" class="form-label text-light">Series</label>
                <select name="series_id" id="series_id" class="form-select" required>
                    <option value="">Select series</option>
                    @foreach($series as $serie)
                        <option value="{{ $serie->id }}" {{ old('series_id') == $serie->id ? 'selected' : '' }}>
                            {{ $serie->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label for="price" class="form-label text-light">Price (USD)</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control"
                       placeholder="Enter price"
                       value="{{ old('price') }}" required>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label text-light">Code</label>
                <input type="text" name="code" id="code" class="form-control"
                       value="{{ old('code') }}" required>
            </div>


            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label text-light">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control"
                          placeholder="Write product description...">{{ old('description') }}</textarea>
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label for="image" class="form-label text-light">Product Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-warning w-100 mt-3 btn-glow">Save Product</button>
        </form>
    </div>

    <style>
        .form-box {
            border: 1px solid #ffc107;
            background: linear-gradient(145deg, #1e1e2f, #2b2b3d);
        }
        .form-control, .form-select {
            background-color: #26263a !important;
            color: #fff !important;
            border: 1px solid #555;
        }
        .form-control:focus, .form-select:focus {
            border-color: #ffc107;
            box-shadow: 0 0 5px #ffc107;
        }
        .btn-glow {
            font-weight: bold;
            border-radius: 6px;
            background: linear-gradient(135deg, #ffc107, #ffdf6b);
            color: #000;
            transition: 0.3s ease;
        }
        .btn-glow:hover {
            background: linear-gradient(135deg, #ffd74a, #ffe48c);
            box-shadow: 0 0 8px #ffc107;
        }
    </style>
@endsection
