$(document).ready(function() {
    var table = $('#usersTable').DataTable({
        ajax: {
            url: 'fetch_users.php',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'location' },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <button class="btn btn-sm btn-warning edit-btn" data-id="${row.id}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id}">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                }
            }
        ]
    });

    $('#userForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var url = $('#userId').val() ? 'update_user.php' : 'create_user.php';
        
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(response) {
                if(response.success) {
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                    showMessage(response.message, 'success');
                } else {
                    showMessage(response.message, 'danger');
                }
            },
            error: function() {
                showMessage('An error occurred!', 'danger');
            }
        });
    });

    $(document).on('click', '.edit-btn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: 'get_user.php',
            type: 'GET',
            data: { id: userId },
            success: function(response) {
                if(response.success) {
                    $('#userId').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#email').val(response.data.email);
                    $('#location').val(response.data.location);
                    $('#modalTitle').text('Edit User');
                    $('#userModal').modal('show');
                }
            }
        });
    });

    $(document).on('click', '.delete-btn', function() {
        if(confirm('Are you sure you want to delete this user?')) {
            var userId = $(this).data('id');
            $.ajax({
                url: 'delete_user.php',
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    if(response.success) {
                        table.ajax.reload();
                        showMessage(response.message, 'success');
                    }
                }
            });
        }
    });

    function showMessage(message, type) {
        $('#messageContent').html(`
            <div class="alert alert-${type}">
                ${message}
            </div>
        `);
        $('#messageModal').modal('show');
    }
});