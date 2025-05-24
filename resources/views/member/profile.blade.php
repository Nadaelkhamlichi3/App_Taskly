<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile - Taskly</title>
    <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png" />
    <style>
        body {
            overflow: hidden; /* Désactive le scroll */
        }
        .profile-avatar {
            width: 120px;
            height: 120px;
            background-color: #d6c9b4;
            color: black;
            font-size: 48px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 20px;
            border: 4px solid black;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .profile-avatar:hover {
            transform: scale(1.05);
        }
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        .btn-edit {
            transition: all 0.3s;
        }
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .info-item {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-custom">
    <div class="containerprofil d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg col-md-6 bg-custom1 text-custom">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->username, 0, 1)) }}
            </div>

            <h2 class="text-center mb-4">My Profile</h2>

            <div class="info-item">
                <p class="text-center mb-1"><strong><i class="bi bi-person-fill"></i> Full name :</strong> {{ $user->username }}</p>
            </div>
            <div class="info-item">
                <p class="text-center mb-1"><strong><i class="bi bi-envelope-fill"></i> Email :</strong> {{ $user->email }}</p>
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('dashboard.user', ['id' => $user->id]) }}" class="btn btn-dark btn-edit">
                    <i class="bi bi-arrow-left"></i> Return to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Example of additional functionality
        document.addEventListener('DOMContentLoaded', function() {
            // You can add JavaScript for profile editing here
            console.log('Profile page loaded');
        });
    </script>
</body>
</html>