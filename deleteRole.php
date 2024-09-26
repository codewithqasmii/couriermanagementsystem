<?php
// Include the connection file
include("connection.php");

// Check if the id is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to delete the user data
    $sql = "delete from users where id = '$id'";
    mysqli_query($conn, $sql);

    // Redirect to the users list page
    header("Location: user.php");
    exit;
}
?>

<!-- You can add a confirmation message here if you want -->
