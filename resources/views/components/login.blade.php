<div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                @if($errors->any())
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="card mt-3">
                    <div class="card-header text-center text-white bg-secondary">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="{{ formRouteHandler($guard) }}" method="post">
                            @csrf
                            <label for="email">Enter email</label>
                            <input type="email" name="email" class="form-control" id="email" autocomplete="username" value="{{ old(key: 'email') }}">
                            @error('email')
                                {{ validationMessage($message) }}
                            @enderror
                            <label for="password">Enter password</label>
                            <input type="password" name="password" class="form-control" id="password" autocomplete="new-password">
                            @error('password')
                                {{ validationMessage($message) }}
                            @enderror
                            <button type="submit" class="btn btn-primary mt-2 w-100">Login</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p>Don't have an account? <a href="{{ route('adminSignupForm') }}">Register</a></p>
                    </div>
            </div>
        </div>
    </div>
</div>