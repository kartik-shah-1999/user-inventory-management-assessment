<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                @session('message')
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                    </div>
                @endsession
                <div class="card mt-3">
                    <div class="card-header text-center text-white bg-secondary">
                        Sign Up
                    </div>
                    <div class="card-body">
                        <form action="{{ formRouteHandler($guard) }}" method="post">
                            @csrf
                            <label for="name">Enter name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                            @error('name')
                                {{ validationMessage($message) }}
                            @enderror
                            <label for="email">Enter email</label>
                            <input type="email" name="email" class="form-control" id="email" autocomplete="username" value="{{ old(key: 'email') }}">
                            @error('email')
                                {{ validationMessage($message) }}
                            @enderror
                            <label for="pass1">Enter password</label>
                            <input type="password" name="pass1" class="form-control" id="pass1" autocomplete="new-password">
                            @error('pass1')
                                {{ validationMessage($message) }}
                            @enderror
                            <label for="pass2">Re-enter password</label>
                            <input type="password" name="pass2" class="form-control" id="pass2" autocomplete="new-password">
                            @error('pass2')
                                {{ validationMessage($message) }}
                            @enderror
                            <button type="submit" class="btn btn-primary mt-2 w-100">Sign Up</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p>Already have an account? <a href="{{ route($guard.'LoginForm') }}">Login</a></p>
                    </div>
            </div>
        </div>
    </div>
</div>