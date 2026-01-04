<x-header />

<x-dashboard.header />

@if(session('success'))
    <div class="alert alert-success my-2 alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($publishedProducts->isNotEmpty())
<div class="fluid-container">
    <table class="table table-bordered text-center">
        <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($publishedProducts as $product)
                <tr>
                    <td>
                        <img src="{{ $product->image ? Storage::url($product->image) : asset('images/default.png') }}" alt="product-image" width="200" height="200" style="border-radius: 10px;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category ?? 'Uncategorized' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    
<div class="d-flex justify-content-center">
    {{ $publishedProducts->links() }}
</div>
@else
    <div class="d-flex justify-content-center">
        <span style="font-size: 2rem;">No products found. <a href="{{ route('productForm') }}">Create</a> product</span>
    </div>
@endif

<x-footer />