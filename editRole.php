<?php
session_start();
?>
<?php
include("connection.php");

include("header.php");

// Check for errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to select the user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the form data
        $uname = $_POST['uname'];
        $upwd = $_POST['upwd'];
        $role = $_POST['role'];
        $branch_name = $_POST['branch_name'];
        $uemail = $_POST['uemail'];

        // Query to update the user data
        $stmt = $conn->prepare("UPDATE users SET uname = :uname, upwd = :upwd, role = :role, branch_name = :branch_name, uemail = :uemail WHERE id = :id");
        $stmt->bindParam(":uname", $uname);
        $stmt->bindParam(":upwd", $upwd);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":branch_name", $branch_name);
        $stmt->bindParam(":uemail", $uemail);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            echo '<script>alert("Role updated successfully!");</script>';
        } else {
            echo "Error updating data: " . $stmt->errorInfo()[2];
        }
        $branches = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Redirect to the users list page
        echo '<script>window.location.href = "user.php";</script>';
        exit;
    }
}

?>

<!-- Blank Start -->
<div class="container">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0 m-5">
        <div class="col-md-12">
            <div class="container mt-3">
                <h2 class="text-center">Edit Agent List</h2>

                <form method="post" class="col-lg-8 col-md-8 col-sm-12 mx-auto">
                    <label for="branch_name">Branch Name:</label>
                    <select class="form-control" name="branch_name" required>
                        <?php
                        $stmt = $conn->prepare("SELECT b_name FROM branch");
                        $stmt->execute();
                        $result_branch = $stmt->fetchAll();
                        foreach ($result_branch as $row) {
                            $selected = ($row['b_name'] == $result['branch_name']) ? 'selected' : '';
                            echo '<option value="' . $row['b_name'] . '" ' . $selected . '>' . $row['b_name'] . '</option>';
                        }
                        ?>
                    </select>
                    <div class="form-group mt-3">
                        <label>E-mail:</label>
                        <input class="form-control" type="text" name="uemail" value="<?php echo $result['uemail']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input class="form-control" type="text" name="uname" value="<?php echo $result['uname']; ?> " required>

                    </div>

                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <div class="input-group">
                            <input id="pwd" class="form-control" type="password" name="upwd" value="<?php echo $result['upwd']; ?>" required pattern="(?=.*[a-z])(?=.*\d).{6,}" title="Password must contain number and letter, and be at least 6 characters long">
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword()">
                                    <i id="pwd-icon" class="fas fa-eye-slash" style="font-size: 23px;"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Role:</label>
                        <select name="role" class="form-control">
                            <option value="<?php echo $result['role']; ?>" selected><?php echo $result['role']; ?></option>
                            <option value="admin">Admin</option>
                            <option value="agent">Agent</option>
                            <option value="user">User </option>
                        </select><br>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="Update">Update</button>

                    <!-- <input type="submit" name="submit" value="Update"> -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php
include("footer.php");
?>

<!-- hide and see password -->
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