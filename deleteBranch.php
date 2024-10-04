
<?php
session_start();
// Include the database connection file
include("connection.php");
// Get the branch ID from the URL parameter
$b_id = $_GET['id'];

// Prepare the SQL query to delete the branch
$sql = "DELETE FROM branch WHERE b_id = :b_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':b_id', $b_id);
$stmt->execute();

// Redirect to the view branch page
header('Location: viewBranch.php');
exit;