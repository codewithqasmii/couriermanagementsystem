<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>DASHMIN - Bootstrap Admin Template</title>
  <meta content="width=device-width
    , initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


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
include("connection.php");
?>
<?php
if (isset($_POST['submit'])) {
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  if ($new_password == $confirm_password) {
    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE users SET upwd = :new_password WHERE uname = :uname");
    $stmt->bindParam(':new_password', $new_password);
    $stmt->bindParam(':uname', $_SESSION['uname']);
    $stmt->execute();

    // Remove the password reset token from the database
    $stmt = $conn->prepare("UPDATE users SET password_reset_token = '' WHERE uname = :uname");
    $stmt->bindParam(':uname', $_SESSION['uname']);
    $stmt->execute();

    // Remove the token from the session
    unset($_SESSION['password_reset_token']);
    unset($_SESSION['uname']);

    $success = "Password reset successfully!";
  } else {
    $error = "Passwords do not match!";
  }
}
?>

<!-- Reset Password Form -->
<div class="container mt-5 ">
  <div class="row bg-light rounded justify-content-center mx-0 m-5">
    <div class="col-lg-6 col-md-6 col-sm-12">
      <img src="img/logo.png" alt="" width="300px" class="mx-auto d-block">
      <h2 class="text-center">Reset Password</h2>

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

        <!-- show success message -->
        <div class="d-flex justify-content-center ">
          <?php if (isset($success) && !empty($success)): ?>
            <h6 class="btn btn-success" id="success">
              <?php echo $success; ?>
            </h6>
          <?php endif; ?>
        </div>

        <form method="post">
        <div class="mb-3">
          <label for="new_password">New Password:</label>
          <input type="password" class="form-control" id="new_password" placeholder="Enter new password" name="new_password" required pattern="(?=.*[a-z])(?=.*\d).{6,}" title="Password must contain number and letter, and be at least 6 characters long" >
        </div>
        <div class="mb-3">
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="confirm_password" required>
        </div>
        <button type="submit" name="submit" class="btn btn-danger">Submit</button>
        <a href="index.php" class="btn btn-danger">Login</a>
        </form>
    </div>


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