<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM parcels WHERE track_id LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    if ($data) {
        echo "<h2>Parcel Status:</h2>";
        echo "Track ID: " . $data['track_id'] . "<br>";
        echo "Status: " . $data['status'] . "<br>";
    } else {
        echo "No parcel found with track ID " . $search;
    }
}
?>