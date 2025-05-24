@extends('layouts.appInvite')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="bi bi-list-task text-dark me-2"></i>
                Tasks for {{ $member->name }} - Project: {{ $project->title_projet }}
            </h2>
            <span class="badge bg-dark">
                {{ $tasks->count() }} {{ Str::plural('task', $tasks->count()) }}
            </span>
        </div>

        @if ($tasks->isEmpty())
            <div class="alert alert-info">
                <i class="bi bi-info-circle-fill me-2"></i> No tasks assigned yet.
            </div>
        @else
            <div class="row g-4">
                @foreach ($tasks as $task)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">
                                        <i class="bi bi-card-text text-dark me-2"></i>
                                        {{ $task->title }}
                                    </h5>
                                    <span class="badge 
                                        @if($task->status == 'Completed') bg-success
                                        @elseif($task->status == 'In Progress') bg-warning text-dark
                                        @else bg-secondary
                                        @endif">
                                        {{ $task->status }}
                                    </span>
                                </div>
                                
                                @if($task->description)
                                    <p class="card-text mt-3">
                                        <i class="bi bi-text-paragraph text-dark me-2"></i>
                                        {{ Str::limit($task->description, 100) }}
                                    </p>
                                @endif
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar text-dark me-1"></i>
                                        @if($task->due_date)
                                            Due: {{ ($task->due_date) }}
                                        @else
                                            No deadline
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection