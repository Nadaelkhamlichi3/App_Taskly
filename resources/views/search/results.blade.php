@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">
        <i class="bi bi-search me-2"></i>Search Results for "{{ $query }}"
    </h4>
    
    <div class="search-results">
        @if($tasks->isEmpty() && $members->isEmpty())
            <div class="alert alert-info d-flex align-items-center">
                <i class="bi bi-info-circle-fill me-2"></i>
                No results found for your search.
            </div>
        @else
            @if(!$tasks->isEmpty())
                <h4 class="mt-4 mb-3">
                    <i class="bi bi-list-task me-2"></i>Tasks
                </h4>
                <div class="row task-results">
                    @foreach($tasks as $task)
                        <div class="col-md-6  mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="bi bi-card-text me-2"></i>{{ $task->title }}
                                    </h4>
                                    <p class="card-text">{{ Str::limit($task->description, 150) }}</p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <i class="bi bi-flag me-2"></i>
                                            Status: <span class="badge bg-secondary">{{ $task->status }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-calendar me-2"></i>
                                            Due: {{ $task->due_date }}
                                        </li>
                                        <li class="list-group-item">
                                            <i class="bi bi-person me-2"></i>
                                            Assigned to: {{ $task->assignedMember->name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
            @if(!$members->isEmpty())
                <h4 class="mt-4 mb-3">
                    <i class="bi bi-people me-2"></i>Team Members
                </h4>
                <div class="row member-results">
                    @foreach($members as $member)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="bi bi-person-circle" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <h4 class="card-title">{{ $member->name }}</h4>
                                    <p class="card-text">
                                        <i class="bi bi-envelope me-2"></i>{{ $member->email }}
                                    </p>
                                    <span class="badge bg-dark">
                                        <i class="bi bi-person-badge me-1"></i>
                                        {{ $member->role }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</div>
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-weight: normal;
    }
</style>
@endsection