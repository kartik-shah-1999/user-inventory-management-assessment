@auth('admin')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
        </a>

        <div class="d-flex align-items-center">
            @auth('admin')
                <div class="text-white me-3 text-end mr-4">
                    <small class="text-muted d-block">Welcome</small>
                    <span class="fw-semibold">
                        {{ auth('admin')->user()->name }}
                    </span>
                </div>

                <button type="button" class="btn btn-outline-light btn-sm logout" data-url="{{ route('adminLogout') }}">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            @endauth
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <ul class="nav nav-pills mb-3" id="adminTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href=>
                <i class="bi bi-box-seam me-1"></i> View Products
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" href=>
                <i class="bi bi-plus-circle me-1"></i> Create Product
            </a>
        </li>

        <li class="nav-item" role="presentation">
            <a class="nav-link" href=>
                <i class="bi bi-people me-1"></i> View Users
            </a>
        </li>
    </ul>
</div>


@endauth

