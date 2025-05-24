<div class="modal fade" id="addTaskModal{{ $project->id_projet }}" tabindex="-1" aria-labelledby="addTaskModalLabel{{ $project->id_projet }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #e8e2da;" >
            <div class="modal-header">
                <h3 class="modal-title" id="addTaskModalLabel{{ $project->id_projet }}"><b>Add a task</b></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id_projet }}">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title :</label>
                        <input type="text" class="form-control" id="title" name="title" required placeholder="Enter task title...">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description :</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter task description..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date :</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" placeholder="Select due date...">
                    </div>
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Assign to :</label>
                        <select class="form-select" id="member_id" name="member_id" required>
                            @foreach($project->members as $member)
                                <option value="{{ $member->id_member }}">{{ $member->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>