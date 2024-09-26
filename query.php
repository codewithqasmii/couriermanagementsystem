<?php

if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/karachi');

    $sql = "insert into users (uname,upwd,role,added_date) values ('" . $_POST['uname'] . "','" . $_POST['upwd'] . "','" . $_POST['role'] . "','" . date('Y-m-d h:i:s') . "')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Registered');</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "\\n" . mysqli_error($conn) . "');</script>";
    }
}

?>





