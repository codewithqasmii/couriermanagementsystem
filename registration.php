<?php

include('connection.php');

if (isset($_POST['submit'])) {
  date_default_timezone_set('Asia/karachi');

  $sql = "insert into users (uname,upwd,role,added_date) values ('" . $_POST['uname'] . "','" . $_POST['upwd'] . "','" . $_POST['role'] . "','" . date('Y-m-d h:i:s') . "')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    echo "<script>alert('User Registered');</script>";
    echo '<script>window.location.href = "index.php";</script>';

  } else {
    echo "<script>alert('Error: " . $sql . "\\n" . mysqli_error($conn) . "');</script>";
  }
  
}



?>

<?php
include('connection.php');
?>

<?php
include("loginHeader.php");
?>

<!-- Blank Start -->
<div class="container ">
  <div class="row min-vh-100 bg-light rounded align-items-center justify-content-center mx-0 m-5">
    <div class="col-md-12">
      <div class="container">
        <h1 class="text-center text-primary">WELCOME TO CMS</h1>
        <h2 class="text-center mt-3">User Registration Form</h2>
        <form method="post">
          <div class="mb-3 mt-3 mx-auto w-75">
            <label for="email">Username:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname" required>
          </div>
          <div class="mb-3 mt-3 mx-auto w-75">
            <label for="pwd">Password:</label>
            <div class="input-group-append">
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upwd" required>
              <span class="input-group-text" onclick="togglePassword()">
                <i id="pwd-icon" class="fas fa-eye-slash"></i>
              </span>

            </div>
          </div>

            <div class="mb-3 mt-3 mx-auto w-75">
              <label for="pwd">Role:</label>
              <select class="form-control" name="role" required>
                <option value="" disabled selected>Select Role</option>
                <!-- <option value="agent">Agent</option> -->
                <option value="user">User</option>
              </select>
              <button type="submit" name="submit" class="btn btn-primary mt-3">Register</button>
              <a href="index.php" class="btn btn-primary mt-3">Login</a>
            </div>


          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Blank End -->
  <script>
    function togglePassword() {
      var pwdInput = document.getElementById("pwd");
      var pwdIcon = document.getElementById("pwd-icon");

      if (pwdInput.type === "password") {
        pwdInput.type = "text";
        pwdIcon.className = "fas fa-eye";
      } else {
        pwdInput.type = "password";
        pwdIcon.className = "fas fa-eye-slash";
      }
    }
  </script>

  <?php
  include("footer.php");
  ?>