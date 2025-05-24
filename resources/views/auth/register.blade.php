<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Signup Page</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}">
    
    <!-- Custom CSS -->
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png">
</head>
<body class="bg-custom1">

    @include('layouts.navbar')

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg col-md-6 bg-custom1 text-custom">
            <div class="text-center mb-3">
                <img src="{{ asset('static/taskly.png') }}" alt="Taskly" width="300" height="120"> 
            </div>
            <form action="{{ route('register.submit') }}" method="post" class="form-group" autocomplete="off">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-2">
                    <label for="username" class="form-label">Username :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Fullname or Company name..." required>
                    </div>
                    @error('username')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email..." required>
                    </div>
                    @error('email')
                    <div class="alert alert-danger mt-1">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Password :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password..." required>
                    </div>
                    @error('password')
                        <div class="alert alert-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div> 

                <input type="submit" class="btn btn-dark w-100 mt-3" value="Sign Up" name="signup">
            </form>
        </div>
    </div>

    @include('layouts.footer')

    <script src="{{ asset('static/bootstrap-5.3.3/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.min.js') }}"></script>

    
</body>
</html>
