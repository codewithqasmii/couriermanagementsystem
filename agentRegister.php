<?php
session_start();
?>

<?php
include("connection.php");
?>

<?php
if (isset($_POST['submit'])) {
  date_default_timezone_set('Asia/karachi');
  $uemail = $_POST['uemail'];
  $uname = $_POST['uname'];
  $upwd = $_POST['upwd'];
  $role = $_POST['role'];
  $branchName = $_POST['branch_name'];
  $branchCity = $_POST['city'];

  // Check if agent already exists
  $check_sql = "SELECT * FROM users WHERE uname = :uname AND role = 'agent'";
  $check_stmt = $conn->prepare($check_sql);
  $check_stmt->bindParam(":uname", $uname);
  $check_stmt->execute();
  $check_result = $check_stmt->fetch();

  if ($check_result) {
    $error = 'Error: Agent already exists';
  } else {
    $sql = "insert into users (uemail,uname,upwd,role,branch_name,branch_city,added_date) values (?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $uemail);
    $stmt->bindParam(2, $uname);
    $stmt->bindParam(3, $upwd);
    $stmt->bindParam(4, $role);
    $stmt->bindParam(5, $branchName);
    $stmt->bindParam(6, $branchCity); // Change the index to 6
    $addedDate = date('Y-m-d h:i:s'); // Assign date to a variable
    $stmt->bindParam(7, $addedDate); // Pass the variable to bindParam
    $result = $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
      $success = 'Agent registered successfully';
    } else {
      $error = 'Error: ' . $sql . '\\n' . $conn->errorInfo()[2];
    }
  }
}
?>
<?php
include("header.php")
?>


<div class="container ">
  <div class="row min-vh-100 bg-light rounded align-items-center justify-content-center mx-0 m-5">
    <div class="col-md-12">
      <div class="container">
        <h1 class="text-center text-danger">WELCOME TO CMS</h1>
        <h2 class="text-center mt-3">Agent Registration Form</h2>

        <!-- show error or success message -->
        <div class="d-flex justify-content-center ">
          <?php if (isset($error) && !empty($error)): ?>
            <h6 class="btn btn-danger" id="error">
              <?php echo $error; ?>
            </h6>
          <?php elseif (isset($success) && !empty($success)): ?>
            <h6 class="btn btn-success" id="success">
              <?php echo $success; ?>
            </h6>
          <?php else: ?>
            <!-- If no error or success, display a transparent button -->
            <h6 class="btn btn-transparent" id="error" style="visibility: hidden;">
              <!-- No content needed here -->
            </h6>
          <?php endif; ?>
        </div>

        <form method="post">

          <div class="mb-3 mt-3 mx-auto w-75">
            <label for="city">City:</label>
            <select class="form-control" name="city" id="city" required>
              <option value="" disabled selected>Select City</option>
              <?php
              $sql = "SELECT DISTINCT b_city FROM branch";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->fetchAll();
              foreach ($result as $row) {
                echo '<option value="' . $row['b_city'] . '">' . $row['b_city'] . '</option>';
              }
              ?>
            </select>
          </div>
<div>
          <div class="mb-3 mt-3 mx-auto w-75">
            <label for="branch_name">Branch:</label>
            <select class="form-control" name="branch_name" id="branch_name" required>
              <option value="" disabled selected>Select Branch</option>
            </select>
          </div>
      </div>
      <div class="mb-3 mt-3 mx-auto w-75">
        <label for="email">E-mail:</label>
        <input type="email" class="form-control" id="email" placeholder="Enter E-mail" name="uemail" required>
      </div>


      <div class="mb-3 mt-3 mx-auto w-75">
        <label for="email">Agent Name:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter Agent Name" name="uname" required pattern="[a-zA-Z0-9\s]{3,}">
      </div>
      <div class="mb-3 mt-3 mx-auto w-75">
        <label for="pwd">Password:</label>
        <div class="input-group-append">
          <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upwd" required pattern="(?=.*[a-z])(?=.*\d).{6,}" title="Password must contain number and letter, and be at least 6 characterslong">
          <span class="input-group-text" onclick="togglePassword()">
            <i id="pwd-icon" class="fas fa-eye-slash"></i>
          </span>

        </div>
      </div>

      <div class="mb-3 mt-3 mx-auto w-75">
        <label for="pwd">Role:</label>
        <select class="form-control" name="role" required>
          <option value="" disabled selected>Select Role</option>
          <option value="agent">Agent</option>
          <option value="user">User</option>
        </select>
        <button type="submit" name="submit" class="btn btn-danger mt-3">Register</button>
        <!-- <a href="index.php" class="btn btn-danger mt-3">Login</a> -->
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

<script>
  $(document).ready(function() {
    $('#city').on('change', function() {
      var city = $(this).val();
      $.ajax({
        type: 'POST',
        url: 'getBranch.php',
        data: {
          city: city
        },
        success: function(data) {
          $('#branch_name').html(data);
        }
      });
    });
  });
</script>