<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet">
    <script type="module" src="{{ asset('static/script.js') }}" defer></script>
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png">
    <title>Taskly - Dashboard</title>

  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}">
  <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="text-custom">

<div class="d-flex" style="height: 100vh; overflow: hidden;">

  <!-- Sidebar -->
  <aside class="d-flex flex-column justify-content-between p-3 text-white" style="width: 250px; background-color: #d6c9b4;">
    <div>
        <div class="text-center mb-4">
            <img src="{{ asset('static/taskly.png') }}" alt="Taskly" class="img-fluid">
        </div>
        <nav class="nav flex-column">
            <a class="btn btn-outline-dark mb-3" href="{{route("welcome")}}">
                <i class="bi bi-house-door-fill me-2"></i>Home
            </a>
            <a class="btn btn-outline-dark mb-3" href="#" data-bs-toggle="modal" data-bs-target="#projectModal">
                <i class="bi bi-folder-fill me-2"></i>Projects
            </a>
            <a class="btn btn-outline-dark mb-3" href="#" data-bs-toggle="modal" data-bs-target="#tasksModal{{ $project->id_projet }}" >
                <i class="bi bi-check2-square me-2"></i>Tasks
                <span class="badge bg-dark ms-1">{{ $project->tasks->count() }}</span>
            </a>
            <a class="btn btn-outline-dark mb-3" href="#" data-bs-toggle="modal" data-bs-target="#membersModal{{ $project->id_projet }}">
              <i class="bi bi-people-fill me-2"></i>Members
            </a>
            <a class="btn btn-outline-dark mb-3" href="{{route("boards.invite.member",$project->id_projet)}}">
                <i class="bi bi-person-plus-fill me-2"></i>Add a Member
            </a>
        </nav>

    </div>
    <div>
        <a href="{{ route("boards.create") }}" class="btn btn-dark w-100">
            <i class="bi bi-plus-lg me-2"></i>New project
        </a>
    </div>
  </aside>

  <!-- Main content -->
  <div class="flex-grow-1 d-flex flex-column" style="background-color: #e8e2da;">
    
    <!-- Navbar -->
    <header class="navbar navbar-expand px-4 shadow-sm" style="background-color: #d6c9b4;">
      <div class="container-fluid">
        <form class="d-flex w-50" action="{{ route('search') }}" method="GET">
          <input type="hidden" name="id" value="{{ $project->id_projet }}" class="form-control">
          <input type="text" name="query" placeholder="Search tasks, members in your project..." class="form-control me-2 flex-grow-1">
        </form>
        <div class="dropdown">
          <button class="btn btn-outline bg-custom2 dropdown-toggle" type="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" style="background-color: #e8e2da;">
            <li><a class="dropdown-item" href="{{ route('profil', ['id' => Auth::user()->id]) }}">My Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('member.settings') }}">Settings</a></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <!-- Main dashboard content -->
    <main class="flex-grow-1 p-4 overflow-auto">
      @yield('content')
    </main>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="membersModal" tabindex="-1" aria-labelledby="membersModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="background-color: #e8e2da;">
      <div class="modal-header">
        <h3 class="modal-title" id="membersModalLabel"><b>Add Member</b></h3>
        <button type="button" class="btn-close p-3" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" autocomplete="off">
          @csrf
          <div class="mb-3">
            <label for="fullname" class="form-label">Full name :</label>
            <input type="text" id="fullname" class="form-control" name="fullname" placeholder="Full name..." required>
          </div>
          <div class="mb-3">
            <label for="emailMbr" class="form-label">Email address :</label>
            <input type="email" id="emailMbr" class="form-control" name="emailMbr" placeholder="Used to send the invitation..." required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role :</label>
            <input type="text" id="role" class="form-control" name="role" placeholder="Role in the project..." required>
          </div>
          <div class="d-grid">
            <input type="submit" class="btn btn-dark" value="Save" name="save">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="tasksModal{{ $project->id_projet }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #e8e2da;">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="bi bi-card-checklist"></i> <b>Tasks</b> - {{ $project->title_projet }}
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($project->tasks as $task)
                    @php
                        $dueDate = $task->due_date instanceof \Carbon\Carbon 
                            ? $task->due_date 
                            : \Carbon\Carbon::parse($task->due_date);
                    @endphp
                    
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title mb-2">{{ $task->title }}</h6>
                                
                                <p class="card-text small text-muted mb-2">
                                    {{ Str::limit($task->description, 80) }}
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-end">
                                    <div>
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-person"></i>
                                            {{ $task->assignedMember->name ?? 'Non assigné' }}
                                        </span>
                                    </div>
                                    
                                    <div class="text-end">
                                        <!-- Date corrigée -->
                                        <div class="small {{ $dueDate->isPast() ? 'text-danger' : 'text-muted' }}">
                                            <i class="bi bi-calendar"></i>
                                            {{ $dueDate->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style minimal -->
<style>
    .card {
        border-radius: 8px;
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>
</body>
</html>
