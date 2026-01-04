<x-header />

<x-dashboard.header />

<div class="confirmation-message my-2"></div>

@if(session('success'))
    <div class="alert alert-success my-2 alert-dismissible fade show text-center" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<x-confirmation-modal title="Confirm delete" message="Are you sure you want to delete the item?"/>

<x-dashboard.products :publishedProducts=$publishedProducts />

<x-footer />