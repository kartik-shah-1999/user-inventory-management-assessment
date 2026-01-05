<x-header />

<x-dashboard.header />

@php
    $formClass = "form-control w-100 mb-2";
@endphp

@if (session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@elseif (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

<div class="container mt-3">
    <h3>Update Product</h3>
    <div class="uploaded-image">
        <img src="{{ $product['image'] ? asset('storage/'.$product['image']) : asset('images/default.png') }}" alt="product-image" >
    </div>
    <form action="{{ route('updateProduct', $product['id']) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="file" name="image" class="w-100 mb-3">
        @error('image')
            {{ validationMessage($message) }}
        @enderror
        <label for="name">Product name</label>
        <input type="text" name="name" id="name" class="{{ $formClass }}" value="{{$product['name']}}">
        @error('name')
            {{ validationMessage($message) }}
        @enderror
        <label for="description">Product description</label>
        <textarea name="description" id="description" class="{{ $formClass }}" >{{ $product['description'] }}</textarea>
        @error('description')
            {{ validationMessage($message) }}
        @enderror
        <label for="category">Category</label>
        <select name="category" class="{{ $formClass }}" id="category">
            <option value="">Select category</option>
        </select>
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="{{ $formClass }}" value="{{ $product['price'] }}">
        @error('price')
            {{ validationMessage($message) }}
        @enderror
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" class="{{ $formClass }}" value="{{ $product['stock'] }}">
        @error('stock')
            {{ validationMessage($message) }}
        @enderror
        <button type="submit" class="btn btn-secondary w-100">Update product</button>
    </form>
</div>

<x-footer />