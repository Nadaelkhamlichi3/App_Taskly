<div class="modal fade" id="membersModal{{ $project->id_projet }}" tabindex="-1" aria-labelledby="membersModalLabel{{ $project->id_projet }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #e8e2da;">
            <div class="modal-header">
                <h3 class="modal-title" id="membersModalLabel{{ $project->id_projet }}">
                    <b>Project members:</b> {{ $project->title_projet }}
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($project->members->isEmpty())
                    <div class="alert alert-warning">No members in this project</div>
                @else
                    <ul class="list-group">
                        @foreach($project->members as $member)
                            <li class="list-group-item d-flex justify-content-between ">
                                <span>{{ $member->name }}</span>
                                <span class="badge bg-dark">{{ $member->email }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="projectDetailsModal{{ $project->id_projet }}" tabindex="-1" aria-labelledby="projectDetailsLabel{{ $project->id_projet }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #e8e2da;">
            <div class="modal-header">
                <h3 class="modal-title" id="projectDetailsLabel{{ $project->id_projet }}">
                    <b style="color:black">Project Details:</b> {{ $project->title_projet }}
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="bg-white p-3 mb-3 rounded shadow-sm">
                    <b><i class="bi bi-card-text"></i> Project Description:</b><br>
                   <div class="p-2 mt-1 bg-light rounded">{{ $project->description_projet }}</div>
                </div>
    
                <div class="bg-white p-3 mb-3 rounded shadow-sm">
                    <b><i class="bi bi-cash-stack"></i> Project Budget:</b><br>
                    <div class="p-2 mt-1 bg-light rounded">{{ $project->budget }} Dh</div>
                </div>
    
                <div class="bg-white p-3 mb-3 rounded shadow-sm">
                    <b><i class="bi bi-calendar-check"></i> Project Deadline:</b><br>
                    <div class="p-2 mt-1 bg-light rounded">{{ $project->delai }}</div>
                </div>
    
                <div class="bg-white p-3 rounded shadow-sm">
                    <b><i class="bi bi-person-circle"></i> Project Owner:</b><br>
                    <div class="p-2 mt-1 bg-light rounded">{{ $project->user->username }}</div>
                </div>
            </div>
        </div>
    </div>
</div>