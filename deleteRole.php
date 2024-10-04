<?php
include("connection.php");
?>

<?php
// Check if the id is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to delete the user data
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Redirect to the users list page
    header("Location: user.php");
    exit;
}
?>

<!-- You can add a confirmation message here if you want -->