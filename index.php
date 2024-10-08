<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>C M S</title>
    <meta content="width=device-width
    , initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" type="image/png" href="img/logo.png" />

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<?php
session_start();


// connection 
include("connection.php");

?>
<!-- if (isset($_POST['submit'])) {
  $sql = "SELECT * FROM users WHERE uname=:uname AND upwd=:upwd";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':uname', $_POST['uname']);
  $stmt->bindParam(':upwd', $_POST['upwd']);
  $stmt->execute();
  $data = $stmt->fetch();

  if (!empty($data)) {
    $_SESSION['user_role'] = $data['role'];
    $_SESSION['username'] = $data['uname'];

    header('location:dashboard.php');
  } else {
    $error = "Error: Username or password is incorrect";
  }
} -->



<?php

if (isset($_POST['submit'])) {
  $sql = "SELECT * FROM users WHERE uname=:uname AND upwd=:upwd";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':uname', $_POST['uname']);
  $stmt->bindParam(':upwd', $_POST['upwd']);
  $stmt->execute();
  $data = $stmt->fetch();

  if (!empty($data)) {
    $_SESSION['user_role'] = $data['role'];
    $_SESSION['username'] = $data['uname'];

    header('location:dashboard.php');
  } else {
    $error = "Error: Username or password is incorrect";
  }
}

?>





<!-- Blank Start -->
<div class="container-fluid ">
  <div class="row bg-light rounded justify-content-center mx-0 m-5">
  <div class="col-lg-6 col-md-6 col-sm-12">

      <img src="img/logo.png" alt="" width="300px" class="mx-auto d-block">        <h1 class="text-center text-primary">WELCOME TO CMS</h1>
        <h2 class="text-center mt-3">Login form</h2>

        <!-- show error button  -->
        <div class="d-flex justify-content-center ">
          <?php if (isset($error) && !empty($error)): ?>
            <h6 class="btn btn-danger" id="error">
              <?php echo $error; ?>
            </h6>
          <?php else: ?>
            <!-- If no error, display a transparent button -->
            <h6 class="btn btn-transparent" id="error" style="visibility: hidden;">
              <!-- No content needed here -->
            </h6>
          <?php endif; ?>
        </div>


        <form method="post">

          <div class="mb-3 mt-3 mx-auto w-75">
            <label for="email">Username:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname" required>
          </div>
          <div class="mb-3 mx-auto w-75">
            <label for="pwd">Password:</label>
            <div class="input-group">
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upwd" required>
              <div class="input-group-append">
                <span class="input-group-text" onclick="togglePassword()">
                  <i id="pwd-icon" class="fas fa-eye-slash" style="font-size: 24px;"></i>
                </span>
              </div>

            </div>
            <button type="submit" name="submit" class="btn btn-danger mt-3">Login</button>
            <a href="registration.php" class="btn btn-danger mt-3">Register</a>
            <p class="mt-3">Forget Password? <a href="forget_password.php">Click here</a></p>
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


    <!-- JavaScript Libraries -->


        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>