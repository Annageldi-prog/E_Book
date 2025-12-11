@extends('admin.layout.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="container-lg py-4">

        <h2 class="text-warning mb-4 fw-bold">Edit Product</h2>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
              enctype="multipart/form-data"
              class="bg-dark p-4 rounded shadow form-box">
            @csrf
            @method('PUT')

            {{-- Product Name --}}
            <div class="mb-3">
                <label class="form-label text-light">Product Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $product->name) }}" required>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label class="form-label text-light">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Author --}}
            <div class="mb-3">
                <label class="form-label text-light">Author</label>
                <select name="author_id" class="form-select" required>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ $product->author_id == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Series --}}
            <div class="mb-3">
                <label class="form-label text-light">Series</label>
                <select name="series_id" class="form-select" required>
                    @foreach($series as $serie)
                        <option value="{{ $serie->id }}"
                            {{ $product->series_id == $serie->id ? 'selected' : '' }}>
                            {{ $serie->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Code --}}
            <div class="mb-3">
                <label class="form-label text-light">Code</label>
                <input type="text" name="code" class="form-control"
                       value="{{ old('code', $product->code) }}" required>
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label class="form-label text-light">Price (USD)</label>
                <input type="number" step="0.01" name="price" class="form-control"
                       value="{{ old('price', $product->price) }}" required>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label class="form-label text-light">Description</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Image --}}
            <div class="mb-3">
                <label class="form-label text-light">Product Image</label>
                <input type="file" name="image" class="form-control">

                @if($product->image)
                    <div class="mt-3">
                        <p class="text-light mb-1">Current Image:</p>
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="product image"
                             style="max-width: 120px; border-radius: 6px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-warning w-100 mt-3 btn-glow">
                Update Product
            </button>
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
