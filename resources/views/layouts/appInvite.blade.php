<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Taskly - Dashboard</title>
    <link href="{{ asset('static/styles.css') }}" rel="stylesheet" />
    <script type="module" src="{{ asset('static/script.js') }}" defer></script>
    <link rel="icon" href="{{ asset('static/tasklyicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('static/bootstrap-5.3.3/css/bootstrap.min.css') }}" />
    <script src="{{ asset('static/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="text-custom">

<div class="d-flex" style="height: 100vh; overflow: hidden;">
  <aside class="d-flex flex-column justify-content-between p-3 text-white" style="width: 250px; background-color: #d6c9b4;">
    <div>
      <div class="text-center mb-4">
        <img src="{{ asset('static/taskly.png') }}" alt="Taskly" class="img-fluid" />
      </div>
      <nav class="nav flex-column">
        <a class="btn btn-outline-dark mb-3" href="{{route("welcome")}}">
          <i class="bi bi-house-door-fill me-2"></i>Home
        </a>
        <a class="btn btn-outline-dark mb-3" href="#" data-bs-toggle="modal" data-bs-target="#projectDetailsModal{{ $project->id_projet }}">  
          <i class="bi bi-folder-fill me-2"></i>Project details
        </a>
        @if(isset($member))
          <a href="{{ route('tasks.member', ['project' => $project->id_projet, 'member' => $member->id_member]) }}" class="btn btn-outline-dark mb-3">
            <i class="bi bi-check2-square me-2"></i>My Tasks
          </a>
        @endif
        <a class="btn btn-outline-dark mb-3" href="#" data-bs-toggle="modal" data-bs-target="#membersModal{{ $project->id_projet }}">
          <i class="bi bi-people-fill me-2"></i>Members
        </a>
        <a href="#" class="btn btn-outline-dark mb-3" data-bs-toggle="modal" data-bs-target="#cannotAddMemberModal">
          <i class="bi bi-person-plus-fill me-2"></i>Add a Member
        </a>
      </nav>
    </div>
    <div>
      <a href="#" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#cannotAddProjectModal">
        <i class="bi bi-plus-lg me-2"></i>Nouveau projet
      </a>
    </div>
  </aside>

  <div class="flex-grow-1 d-flex flex-column" style="background-color: #e8e2da;">
    <header class="navbar navbar-expand px-4 shadow-sm" style="background-color: #d6c9b4;">
      <div class="container-fluid">
        <form class="d-flex w-50" action="{{ route('search') }}" method="GET">
          <input type="hidden" name="id" value="{{ $project->id_projet }}" class="form-control">
          <input type="text" name="query" placeholder="Search tasks, members in your project..." class="form-control me-2 flex-grow-1">
        </form>
      </div>
    </header>

    <!-- Main dashboard content -->
    <main class="flex-grow-1 p-4 overflow-auto">
      @yield('content')
    </main>
  </div>
</div>

<!-- Modals -->
<div class="modal fade" id="cannotAddProjectModal" tabindex="-1" aria-labelledby="cannotAddProjectLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-center" style="background-color: #e8e2da;">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-danger">🚫 You cannot add a project!</h4>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cannotAddMemberModal" tabindex="-1" aria-labelledby="cannotAddMemberLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-center" style="background-color: #e8e2da;">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-danger">🚫 You cannot add a member!</h4>
      </div>
    </div>
  </div>
</div>

</body>
</html>