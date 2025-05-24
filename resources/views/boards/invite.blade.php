<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskly</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png">
</head>
<body class="bg-custom1">

    <div class="navbar-background d-flex align-items-center px-4"></div>

    <div class="container2 d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg col-md-6 bg-custom1 text-custom">
            <div class="text-center mb-3">
                <img src="{{ asset('static/taskly.png') }}" alt="Taskly" width="300" height="120">
            </div>

            <h2 class="text-center mb-4">Invite Members to Project: <br><span class="text-uppercase">{{ $board->title_projet }}</span></h2>

            @if (session('success'))
                <div class="alert alert-success">
                    <strong>Success:</strong> {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('boards.invite.member', ['board' => $board->id_projet]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Member Name :</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Member's Name..." required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Member Email :</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Member's Email..." required>
                </div>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Member Role :</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                    <input type="text" name="role" class="form-control" placeholder="Member's Role..." required>
                </div>
            </div>

            <button type="submit" class="btn btn-dark w-100 mt-3">
                <i class="bi bi-person-plus"></i> Invite
            </button>
    
            <a href="{{ route('dashboard.user', ['id' => Auth::id()]) }}" class="btn btn-secondary w-100 mt-2">
                <i class="bi bi-box-arrow-right"></i> Go to Dashboard
            </a>
            </form> 
        </div>
    </div>

    <script src="{{ asset('static/bootstrap-5.3.3/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.min.js') }}"></script>

</body>
</html>
