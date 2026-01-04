@if($publishedProducts->isNotEmpty())
<div class="fluid-container">
    <table class="table table-bordered text-center products">
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
            @foreach ($publishedProducts as $key => $product)
                <tr style="background-color: {{ $key % 2 === 0 ? '#F2F2F2' : '#fffff'}}">
                    <td>
                        <img src="{{ $product->image ? Storage::url($product->image) : asset('images/default.png') }}" alt="product-image" width="100" height="100" style="border-radius: 10px;">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category ?? 'Uncategorized' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary edit-product" data-id="{{ $product->id }}">Edit</button>
                        @can('delete',$product)
                            <button type="button" class="btn btn-sm btn-danger delete-product" data-id="{{ $product->id }}" data-url={{ route('deleteProduct') }} data-toggle="modal" data-target="#confirmationModal">Delete</button>
                        @endcan
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
        <span style="font-size: 2rem;">No products found.   
        @can('create',\App\Models\Product::class)
            <a href="{{ route('productForm') }}">Create</a> product</span>
        @endcan
    </div>
@endif