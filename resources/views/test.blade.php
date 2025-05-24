                                                                                                                                                                                <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/CreationPrgt.css') }}">
  <title>Taskly</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
    <div class="container">
      <a class="navbar-brand"><img src="{{ asset('images/taskly.png') }}" alt="Taskly Logo" width="120"></a>
    </div>
  </nav>

  <section class="text-center">
    <h2>Start Your First Project</h2>
    <h6>
      Manage multiple projects efficiently by bringing together your tasks, emails,<br>
      calendars, and contacts in the same application. Tools available on desktop, mobile, and web.
    </h6>
  </section>

  <form class="container mt-5" action="{{ route('projects.store') }}" method="POST" id="project-form">
    @csrf
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="mb-3">
          <label for="nom" class="form-label">Project Name</label>
          <input type="text" class="form-control" id="nom" name="nomp" placeholder="Enter project name" required>
        </div>
        <div class="mb-3">
          <label for="desc" class="form-label">Description</label>
          <textarea class="form-control" id="desc" name="description" rows="3" placeholder="Enter project description"></textarea>
        </div>
        <div class="mb-3">
          <label for="Budget" class="form-label">Budget</label>
          <input type="number" class="form-control" id="Budget" name="budget" placeholder="Enter budget" required>
        </div>
        <div class="mb-3">
          <label for="Delai" class="form-label">Deadline</label>
          <input type="date" class="form-control" id="Delai" name="delai" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Invite members</label><br>
          <input type="radio" name="invite" value="yes" id="inviteYes" data-bs-toggle="modal" data-bs-target="#inviteModal">
          <label for="inviteYes">Yes</label>
          <input type="radio" name="invite" value="no" id="inviteNo">
          <label for="inviteNo">No</label>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="inviteModalLabel">Invite Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div id="members-container">
                  <div class="member-entry">
                    <p>Full name:</p>
                    <input type="text" class="form-control" placeholder="Full name" name="member_name[]">
                    <p>Email:</p>
                    <input type="email" class="form-control" placeholder="Enter email" name="member_email[]">
                    <p>Role:</p>
                    <input type="text" class="form-control" placeholder="Enter role" name="member_role[]">
                    <hr>
                  </div>
                </div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-member">+ Add another member</button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <!-- Ce bouton ne fait rien -->
                <button type="button" class="btn btn-primary">Send Invitation</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Bouton principal de soumission -->
        <button type="submit" class="btn btn-primary w-100 mt-3">Save</button>
      </div>
    </div>
  </form>

  <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
  <script>
    // Ajout dynamique de membres
    document.getElementById('add-member').addEventListener('click', function () {
      const container = document.getElementById('members-container');
      const newEntry = container.querySelector('.member-entry').cloneNode(true);
      newEntry.querySelectorAll('input').forEach(input => input.value = '');
      container.appendChild(newEntry);
    });
  </script>
</body>
</html>


