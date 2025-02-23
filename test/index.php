<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <h2>User Management</h2>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
            Add New User
        </button>
        <table id="usersTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $database = new Database();
                $db = $database->getConnection();
                $query = "SELECT * FROM test"; // Make sure this matches your table name
                $stmt = $db->prepare($query);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>
                            <button type='button' class='btn btn-primary btn-sm edit-btn' 
                                    data-id='" . $row['id'] . "'
                                    data-bs-toggle='modal' 
                                    data-bs-target='#userModal'>
                                Edit
                            </button>
                            <button type='button' class='btn btn-danger btn-sm delete-btn' data-id='" . $row['id'] . "'>
                                Delete
                            </button>
                        </td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>

    <!-- User Modal -->
    <?php include('user_modal.php'); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>