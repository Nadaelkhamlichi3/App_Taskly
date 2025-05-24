@extends('layouts.app')

@section('content')
<div class="container">
    @if($projects->isEmpty())
        <div class="alert alert-info">
            You don't have any projects. Create one to get started.
        </div>
    @else
        @foreach($projects as $project)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Project: {{ $project->title_projet }}</h2>
                </div>

                <div class="row g-3">
                    @foreach(['ToDo', 'Doing', 'Done'] as $column)
                        <div class="col-md-4">
                            <div class="kanban-column border p-2 h-100" data-status="{{ $column }}" ondragover="allowDrop(event)" ondrop="drop(event, '{{ $column }}')">
                                <h3>{{ $column }}</h3>

                                @if($column === 'ToDo')
                                    <div class="d-grid mb-3">
                                        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTaskModal{{ $project->id_projet }}">
                                            <i class="bi bi-plus-circle"></i> Add a task
                                        </button>
                                    </div>
                                @endif

                                <div class="kanban-tasks" id="column-{{ strtolower($column) }}">
                                    <!-- Début de la section modifiée -->
                                    @if($project->tasks->where('status', $column)->isNotEmpty())
                                        @foreach($project->tasks->where('status', $column) as $task)
                                            <div class="task-card card mb-2 p-2" data-id="{{ $task->id_task }}" draggable="true" ondragstart="drag(event)">
                                                <div class="task-summary d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">{{ $task->title }}</h5>
                                                    <div class="actions d-flex">
                                                        <button class="btn btn-sm btn-outline-dark me-1 edit-task-btn" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editTaskModal"
                                                            data-task-id="{{ $task->id_task }}"
                                                            data-task-title="{{ $task->title }}"
                                                            data-task-description="{{ $task->description }}"
                                                            data-task-status="{{ strtolower($task->status) }}"
                                                            data-task-due-date="{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '' }}"
                                                            data-task-member-id="{{ $task->assignedMember->id_member ?? '' }}">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <form action="{{ route('tasks.destroy', $task->id_task) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-dark">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="task-details mt-2">
                                                    <p class="mb-2">
                                                        <i class="bi bi-card-text me-2 text-dark"></i>
                                                        {{ $task->description }}
                                                    </p>
                                                    <p class="mb-2 {{ \Carbon\Carbon::parse($task->due_date)->isPast() ? 'text-danger fw-bold' : 'text-dark' }}">
                                                        <i class="bi bi-calendar-event me-2"></i>
                                                        {{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}
                                                    </p>
                                                    <p class="mb-0 text-dark">
                                                        <i class="bi bi-person-circle me-2"></i>
                                                        {{ $task->assignedMember->name ?? 'Non assigné' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="alert alert-info">
                                            No tasks in this column.
                                            @if($column === 'ToDo')
                                                <a href="#" class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#addTaskModal{{ $project->id_projet }}">
                                                    Create a task
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                    <!-- Fin de la section modifiée -->
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Modals -->
                @include('partials.task-modal', ['project' => $project])
                @include('partials.members-modal', ['project' => $project])
            </div>
        @endforeach
    @endif

    <!-- Modal Liste des projets -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: #e8e2da;">
                <div class="modal-header">
                    <h3 class="modal-title" id="projectModalLabel"><b>List of projects</b></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    @if($allProjects->count())
                        <ul class="list-group">
                            @foreach($allProjects as $proj)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <b>{{ $proj->title_projet }}</b>
                                    <a href="{{ route('boards.show', $proj->id_projet) }}" class="btn btn-xl btn-dark w-50">
                                        Open
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No projects available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #e8e2da;">
            <div class="modal-header">
                <h3 class="modal-title" id="editTaskModalLabel"><b>Edit Task</b></h3>
                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <form id="editTaskForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_task" id="edit_task_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_task_title" class="form-label">Title : </label>
                        <input type="text" class="form-control" id="edit_task_title" name="title" placeholder="Enter task title..." required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_task_description" class="form-label">Description :</label>
                        <textarea class="form-control" id="edit_task_description" name="description" rows="3" placeholder="Describe the task in detail..."></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_task_status" class="form-label">Status :</label>
                        <select class="form-select" id="edit_task_status" name="status">
                            <option value="todo">ToDo</option>
                            <option value="doing">Doing</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_task_due_date" class="form-label">Due Date :</label>
                        <input type="date" class="form-control" id="edit_task_due_date" name="due_date">
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_task_member_id" class="form-label">Assigned to :</label>
                        <select class="form-select" id="edit_task_member_id" name="member_id">
                            @foreach($project->members as $member)
                                <option value="{{ $member->id_member }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fonctions pour le drag and drop
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.dataset.id);
    }

    function drop(ev, newStatus) {
        ev.preventDefault();
        const taskId = ev.dataTransfer.getData("text");
        
        fetch(`/tasks/${taskId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            }
        });
    }

    // Gestion du modal d'édition
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.edit-task-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const taskId = this.dataset.taskId;
                const form = document.getElementById('editTaskForm');

                form.action = `/tasks/${taskId}`;
                
                document.getElementById('edit_task_id').value = taskId;
                document.getElementById('edit_task_title').value = this.dataset.taskTitle;
                document.getElementById('edit_task_description').value = this.dataset.taskDescription;
                document.getElementById('edit_task_status').value = this.dataset.taskStatus;
                document.getElementById('edit_task_due_date').value = this.dataset.taskDueDate;
                document.getElementById('edit_task_member_id').value = this.dataset.taskMemberId;
            });
        });
    });
</script>
@endsection