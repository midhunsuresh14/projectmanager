<?php
include 'db_connection.php';

$id = $_GET['id'];

$sql = "SELECT * FROM projects WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Edit Project</title>
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
                max-width: 600px;
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
                        <a class="nav-link" href="projects.php">Projects</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container mt-5">
            <h2>Edit Project</h2>
            <form action="update.php" method="post">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                </div>
                <div class="form-group">
                    <label for="project_name">Project Name</label>
                    <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $row['project_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"><?php echo $row['description']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
} else {
    echo "<div class='alert alert-danger'>Record not found</div>";
}
?>
