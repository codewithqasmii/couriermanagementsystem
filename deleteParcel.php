<?php
include("connection.php");
?>

<?php
include("query.php")
?>

<?php
// Get the parcel ID from the URL
$parcelId = $_GET['id'];

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("DELETE FROM parcels WHERE id = :id");
$stmt->bindParam(":id", $parcelId);
$stmt->execute();

// Redirect back to the parcels list page
header("Location: parcelslist.php");
exit;
?>
