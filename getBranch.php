<?php
include("connection.php");

if (isset($_POST['city'])) {
  $city = $_POST['city'];
  $sql = "SELECT b_name FROM branch WHERE b_city = '$city'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  echo '<option value="" disabled selected>Select Branch</option>';
  foreach ($result as $row) {
    echo '<option value="' . $row['b_name'] . '">' . $row['b_name'] . '</option>';
  }
}
?>