<?php
include 'db_connection.php';

$id = $_POST['id'];
$project_name = $_POST['project_name'];
$description = $_POST['description'];

$sql = "UPDATE projects SET project_name='$project_name', description='$description' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

header("Location: projects.php");
exit;
?>
