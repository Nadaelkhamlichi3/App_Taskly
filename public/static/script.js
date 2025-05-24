window.allowDrop = allowDrop;
window.drag = drag;
window.drop = drop;

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    // Petite vérification de sécurité
    if (!event.target.dataset.id) return;
    event.dataTransfer.setData("text/plain", event.target.dataset.id);
}

function drop(event, newStatus) {
    event.preventDefault();

    const taskId = event.dataTransfer.getData("text/plain");
    const taskCard = document.querySelector(`[data-id='${taskId}']`);

    let targetColumn = event.currentTarget;
    let tasksContainer = targetColumn.querySelector(".kanban-tasks");

    if (!tasksContainer) {
        tasksContainer = targetColumn;
    }

    if (taskCard && tasksContainer) {
        tasksContainer.appendChild(taskCard);
        updateTaskStatus(taskId, newStatus);
    }
}

function updateTaskStatus(taskId, newStatus) {
    fetch(`/tasks/${taskId}/update-status`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": getCSRFToken()
        },
        body: JSON.stringify({ status: newStatus })
    })
    .then(response => {
        if (!response.ok) throw new Error("Erreur lors de la mise à jour");
        return response.json();
    })
    .then(data => {
        console.log("Mise à jour réussie :", data.message);
    })
    .catch(error => {
        console.error("Erreur :", error);
    });
}

function getCSRFToken() {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    return tokenMeta ? tokenMeta.getAttribute("content") : "";
}
function showLoader(form) {
    const button = form.querySelector('button[type="submit"]');
    const spinner = button.querySelector('.spinner-border');
    spinner.classList.remove('d-none');
    button.disabled = true;
}
$(document).ready(function() {
    $('.search-input').on('keyup', function() {
        let query = $(this).val();
        
        if (query.length > 2) {
            $.ajax({
                url: "{{ route('search') }}",
                method: 'GET',
                data: {query: query},
                success: function(data) {
                    $('#search-results').html(data);
                    $('#search-results').show();
                }
            });
        } else {
            $('#search-results').hide();
        }
    });
});
