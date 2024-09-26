<?php
session_start();
?>
<?php
// include("query.php");
include('connection.php');
include("header.php");

// Check for errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to select the user data
    $sql = "select * from users where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the form data
        $uname = $_POST['uname'];
        $upwd = $_POST['upwd'];
        $role = $_POST['role'];

        // Query to update the user data
        $sql = "update users set uname = '$uname', upwd = '$upwd', role = '$role' where id = '$id'";
        mysqli_query($conn, $sql);

        // Redirect to the users list page
        // header("Location:index.php");
        // exit;
        echo '<script>window.location.href = "dashboard.php";</script>';
        exit;
    }
}

?>

<!-- Blank Start -->
<div class="container">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0 m-5">
        <div class="col-md-12">
            <div class="container mt-3">
                <h2 class="text-center">Edit Users List</h2>

                <form method="post" class="col-lg-8 col-md-8 col-sm-12 mx-auto">
                <div class="form-group">
                        <label>Username:</label>
                        <input class="form-control" type="text" name="uname" value="<?php echo $data['uname']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input class="form-control" type="password" name="upwd" value="<?php echo $data['upwd']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Role:</label>
                        <select name="role" class="form-control">
                            <option value="<?php echo $data['role']; ?>" selected><?php echo $data['role']; ?></option>
                            <option value="admin">Admin</option>
                            <option value="agent">Agent</option>
                            <option value="user">User</option>
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