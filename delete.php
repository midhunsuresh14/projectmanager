<?php
include 'db_connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM projects WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

header("Location: projects.php");
exit;
?>
