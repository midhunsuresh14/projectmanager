<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_name = $_POST['project_name'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO projects (user_id, project_name, description) VALUES ('$user_id', '$project_name', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success mt-3'>Project added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}

$sql = "SELECT * FROM projects WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Projects</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .form-group label {
            color: #495057;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .table {
            margin-top: 20px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Project Manager</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Your Projects</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["project_name"]. "</td>
                        <td>" . $row["description"]. "</td>
                        <td>
                            <a href='edit.php?id=" . $row["id"] . "' class='btn btn-sm btn-warning'>Edit</a> 
                            <a href='delete.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure you want to delete this record?');\">Delete</a>
                        </td>
                      </tr>";
            }
            echo "</tbody>
                </table>";
        } else {
            echo "<div class='alert alert-info'>No projects found.</div>";
        }
        ?>

        <form method="post" action="" class="mt-4">
            <div class="form-group">
                <label for="project_name">Project Name</label>
                <input type="text" class="form-control" id="project_name" name="project_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Project</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
