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

// Check for errors
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$error = ''; // Initialize an empty error variable

if (isset($_POST['submit'])) {
  $uname = $_POST['uname'];
  $uemail = $_POST['uemail'];

  // Input validation
  if (!preg_match('/^[a-zA-Z0-9_]+$/', $uname)) {
    $error = 'Invalid username!';
    exit;
  }
  if (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
    $error = 'Invalid email!';
    exit;
  }

  $stmt = $conn->prepare("SELECT * FROM users WHERE uname = :uname AND uemail = :uemail");
  $stmt->bindParam(':uname', $uname);
  $stmt->bindParam(':uemail', $uemail);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (!empty($result)) {
    $data = $result[0];

    // Generate a random password reset token
    $token = bin2hex(random_bytes(16));

    // Update the user's password reset token in the database
    $stmt = $conn->prepare("UPDATE users SET password_reset_token = :token WHERE uname = :uname");
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':uname', $uname);
    $stmt->execute();

    // Store the token in the session
    $_SESSION['password_reset_token'] = $token;
    $_SESSION['uname'] = $uname;

    // Regenerate the session ID to prevent session fixation attacks
    session_regenerate_id();

    // Redirect to the reset password page
    header('Location: reset_password.php');
    exit;
  } else {
    $error = 'Invalid username or email!';
  }
}
?>

<!-- Forget Password Form -->
<div class="container mt-5 ">
  <div class="row bg-light rounded justify-content-center mx-0 m-5">
  <div class="col-lg-6 col-md-6 col-sm-12">
      <img src="img/logo.png" alt="" width="300px" class="mx-auto d-block"> 
      
      <h2 class="text-center">Forget Password</h2>

      
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
    <div class="mb-3">
      <label for="uname">Username:</label>
      <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
    </div>
    <div class="mb-3">
      <label for="uemail">Email:</label>
      <input type="email" class="form-control" id="uemail" placeholder="Enter email" name="uemail" required>
    </div>
    <button type="submit" name="submit" class="btn btn-danger">Submit</button>
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