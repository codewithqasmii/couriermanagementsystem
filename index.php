<?php

session_start();

include('connection.php');

if (isset($_POST['submit'])) {
  $sql = "select * from users where uname='" . $_POST['uname'] . "' AND upwd='" . $_POST['upwd'] . "'";

  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_array($result);

  //print_r($data);

  if (!empty($data)) {
    $_SESSION['user_role'] = $data['role'];
    $_SESSION['username'] = $data['uname'];

    header('location:dashboard.php');
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
        <h2 class="text-center mt-3">Login form</h2>
        <form method="post">
          <div class="mb-3 mt-3 mx-auto w-75">
            <label for="email">Username:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname">
          </div>
          <div class="mb-3 mx-auto w-75">
            <label for="pwd">Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upwd">
              <div class="input-group-append">
                <span class="input-group-text" onclick="togglePassword()">
                  <i id="pwd-icon" class="fas fa-eye-slash"></i>
                </span>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Login</button>
            <a href="registration.php" class="btn btn-primary mt-3">Register</a>
          </div>

        </form>
      </div>
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