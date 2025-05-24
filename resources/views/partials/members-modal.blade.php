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

                                <div>
                                    <form action="{{ route('projects.members.remove', ['project' => $project->id_projet, 'member' => $member->id_member]) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Are you sure you want to remove this member from the project?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-dark">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>