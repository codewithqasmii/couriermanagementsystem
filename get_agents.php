<?php
include("connection.php");

if (isset($_POST['city'])) {
    $city = $_POST['city'];
    $sql = "SELECT uname FROM users WHERE branch_city = '$city'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $agent) {
        echo '<option value="' . $agent['uname'] . '">' . $agent['uname'] . '</option>';
    }
}
?>