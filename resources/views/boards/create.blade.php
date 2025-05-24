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

    <div class="navbar-background d-flex align-items-center px-4">
        <!-- Tu peux ajouter ici plus tard un logo ou des liens -->
    </div>

    <div class="container1 d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg col-md-6 bg-custom1 text-custom">
            <div class="text-center mb-3">
                <img src="{{ asset('static/taskly.png') }}" alt="Taskly" width="300" height="120">
            </div>

            <h2 class="text-center mb-4">Create your project</h2>

            <form method="POST" action="{{ route('boards.store') }}" class="form-group">
                @csrf

                <div class="mb-3">
                    <label for="title_projet" class="form-label">Project Title :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" class="form-control" name="title_projet" placeholder="Enter project title..." required>
                    </div>
                    @error('title_projet')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description_projet" class="form-label">Description :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                        <textarea class="form-control" name="description_projet" placeholder="Describe your project..." rows="3"></textarea>
                    </div>
                    @error('description_projet')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="budget" class="form-label">Budget :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                        <input type="number" class="form-control" name="budget" placeholder="Project budget (optional)">
                    </div>
                    @error('budget')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="delai" class="form-label">Deadline :</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" class="form-control" name="delai">
                    </div>
                    @error('delai')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100 mt-3">
                    <i class="bi bi-folder-plus"></i> Create Project
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('static/bootstrap-5.3.3/js/popper.min.js') }}"></script>
    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.min.js') }}"></script>

</body>
</html>

