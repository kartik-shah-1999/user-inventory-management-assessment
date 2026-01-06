<x-header />

<x-dashboard.header />

@php
    $formClass = "form-control w-100 mb-2";
@endphp

<div class="container mt-3">
    <h3>Create Product</h3>
    <form action="{{ route('createProduct') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" class="w-100 mb-3" value="{{ old('image') }}">
        @error('image')
            {{ validationMessage($message) }}
        @enderror
        <label for="name">Product name</label>
        <input type="text" name="name" id="name" class="{{ $formClass }}" value="{{ old('name') }}">
        @error('name')
            {{ validationMessage($message) }}
        @enderror
        <label for="description">Product description</label>
        <textarea name="description" id="description" class="{{ $formClass }}" >{{ old('description') }}</textarea>
        @error('description')
            {{ validationMessage($message) }}
        @enderror
        <label for="category">Category</label>
        <input type="text" name="category" id="category" class="form-control w-100" value="{{ old('category') }}">
         @error('category')
            {{ validationMessage($message) }}
        @enderror
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="{{ $formClass }}" value="{{ old('price') }}">
        @error('price')
            {{ validationMessage($message) }}
        @enderror
        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" class="{{ $formClass }}" value="{{ old('stock') }}">
        @error('stock')
            {{ validationMessage($message) }}
        @enderror
        <button type="submit" class="btn btn-secondary w-100">Create product</button>
    </form>
</div>

<x-footer />