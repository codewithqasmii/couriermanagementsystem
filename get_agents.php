<?php
include("connection.php");

if (isset($_POST['city'])) {
    $city = $_POST['city'];
    $sql = "SELECT branch_name, uname FROM users WHERE branch_city = :city";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':city', $city);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $branchNames = array_unique(array_column($result, 'branch_name'));
    foreach ($branchNames as $branchName) {
        echo '<optgroup label="' . $branchName . '">';
        foreach ($result as $agent) {
            if ($agent['branch_name'] == $branchName) {
                echo '<option value="' . $agent['uname'] . '">' . $agent['uname'] . '</option>';
            }
        }
        echo '</optgroup>';
    }
}
?>