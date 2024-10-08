<?php
include("connection.php");

$city = $_POST['city'];

$sql = "SELECT DISTINCT branch_name FROM users WHERE branch_city = '$city'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($result) > 0) {
    foreach ($result as $branch) {
        echo "<option value='{$branch['branch_name']}'>{$branch['branch_name']}</option>";
    }
} else {
    echo "<option value=''>No branches found for the selected city.</option>";
}
?>