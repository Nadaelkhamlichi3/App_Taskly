@extends('layouts.appInvite')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Project: {{ $project->title_projet }}</h2>
</div>
<div class="kanban-board">
    @foreach (['ToDo', 'Doing', 'Done'] as $column)
        <div class="kanban-column" data-status="{{ $column }}">
            <h3>{{ $column }}</h3>

            @if ($column === 'ToDo')
                <div class="d-grid mb-3">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                        <i class="bi bi-plus-circle"></i> Add Task
                    </button>
                </div>
            @endif
            <div class="kanban-tasks" id="column-{{ strtolower($column) }}">
                @foreach ($tasks->where('status', $column) as $task)
                    <div class="task-card card mb-2 p-2" data-id="{{ $task->id_task }}" >
                        <div class="task-summary">
                            <h5 class="mb-0">{{ $task->title }}</h5>
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
            </div>
            @include('partials.members', ['project' => $project])
        </div>
    @endforeach
</div>

<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-center" style="background-color: #e8e2da;">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-danger">🚫 You cannot add a task!</h4>
      </div>
    </div>
  </div>
</div>
@endsection