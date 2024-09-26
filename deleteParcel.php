<?php
include("connection.php");
include("query.php")
?>
<?php
// deleteParcel.php

// Connect to the database

// Get the parcel ID from the URL
$parcelId = $_GET['id'];

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("DELETE FROM parcels WHERE id = ?");
$stmt->bind_param("i", $parcelId);
$stmt->execute();

// Redirect back to the parcels list page
header("Location: parcelslist.php");
exit;
?>
