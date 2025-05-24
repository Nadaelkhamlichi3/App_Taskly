<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile - Taskly</title>
    <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png" />
    <style>
        .input-group-text {
            transition: all 0.3s ease;
        }
        .input-group:focus-within .input-group-text {
            background-color: #343a40;
            color: white;
        }
        .form-control {
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #343a40;
            box-shadow: 0 0 0 0.25rem rgba(52, 58, 64, 0.25);
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }
    </style>
</head>
<body class="bg-custom">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card p-0 shadow-lg bg-custom1 text-custom animate__animated animate__fadeIn">
                    <div class="card-header bg-dark text-white">
                        <h2 class="text-center mb-0"><i class="bi bi-gear me-2"></i>Profile Settings</h2>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('member.settings.update') }}" class="form-group">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Full Name :</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-white"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control border-dark" id="name" name="username" value="{{ old('name', auth()->user()->username) }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold">Email :</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-white"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control border-dark" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">New Password :</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-white"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control border-dark" id="password" name="password" placeholder="Leave blank to keep current password">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password :</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-dark text-white"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control border-dark" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 mt-4 py-2 fw-bold">
                                <i class="bi bi-person-check me-2"></i> Update Profile
                            </button>
                        </form>

                        <a href="{{ route('dashboard.user', ['id' => $user->id]) }}" class="btn btn-outline-dark w-100 mt-3 py-2">
                            <i class="bi bi-arrow-left me-2"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('static/bootstrap-5.3.3/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.min.js') }}"></script>
</body>
</html>