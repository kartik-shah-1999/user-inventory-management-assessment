@php
    $guard = getGuard();
@endphp

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-speedometer2 me-2"></i> {{ ucfirst($guard).' Dashboard' }}
        </a>

        <div class="d-flex align-items-center">
                <div class="text-white me-3 text-end mr-4">
                    <small class="text-muted d-block">Welcome</small>
                    <span class="fw-semibold">
                        {{ auth()->guard($guard)->user()->name }}
                    </span>
                </div>

                <button type="button" class="btn btn-outline-light btn-sm logout" data-url="{{ route($guard.'Logout') }}">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <ul class="nav nav-pills mb-3" id="adminTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->url() === route($guard.'Dashboard') ? 'active' : '' }}" href={{ route($guard.'Dashboard') }}>
                <i class="bi bi-box-seam me-1"></i> View Products
            </a>
        </li>

        @can('create', \App\Models\Product::class)
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->url() === route('productForm') ? 'active' : '' }}" href={{ route('productForm') }}>
                    <i class="bi bi-plus-circle me-1"></i> Create Product
                </a>
            </li>
        @endcan

        <li class="nav-item" role="presentation">
            <a class="nav-link {{ request()->url() === route('listUsers') ? 'active' : '' }}" href={{ route('listUsers') }}>
                <i class="bi bi-people me-1"></i> View Users
            </a>
        </li>
    </ul>
</div>

