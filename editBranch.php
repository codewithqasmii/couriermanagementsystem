<?php
session_start();
// Include the database connection file
include("connection.php");

include("header.php");
// Get the branch ID from the URL parameter
$b_id = $_GET['id'];

// Prepare the SQL query to retrieve the branch details
$sql = "SELECT * FROM branch WHERE b_id = :b_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':b_id', $b_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the branch exists
if (!$result) {
    header('Location: viewBranch.php');
    exit;
}

// Display the edit form
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
            <div class="col-md-6">
                <h1 class="text-center text-danger">Edit Branch</h1>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $b_id; ?>" method="post">
                    <input type="hidden" name="b_id" value="<?php echo $b_id; ?>">
                    <!-- <div class="form-group">
                        <label for="b_name">Branch Name:</label>
                        <input type="text" class="form-control" id="b_name" name="b_city" value="<?php echo $result['b_city']; ?>" required pattern="[a-zA-Z0-9\s]{5,}" title="Minimum 5 characters">
                    </div> -->
                    <div class="form-group">
                        <label for="b_name">Branch Name:</label>
                        <input type="text" class="form-control" id="b_name" name="b_name" value="<?php echo $result['b_name']; ?>" required pattern="[a-zA-Z0-9\s]{5,}" title="Minimum 5 characters">
                    </div>
                    <div class="form-group">
                        <label for="b_address">Branch Address:</label>
                        <input type="text" class="form-control" id="b_address" name="b_address" value="<?php echo $result['b_address']; ?>" required pattern="[a-zA-Z0-9\s]{5,}" title="Minimum 5 characters">
                    </div>
                    <div class="form-group">
                        <label for="b_phone">Branch Contact:</label>
                        <input type="tel" class="form-control" id="b_phone" name="b_phone" value="<?php echo $result['b_phone']; ?>" required pattern="[0-9]{10,}" title="Minimum 10 digits">

                    </div>
                    <button type="submit" class="btn btn-danger">Update Branch</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Blank End -->



<?php
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $b_id = $_POST['b_id'];
    $branch_name = $_POST['b_name']; // Update the variable name
    $b_address = $_POST['b_address'];
    $b_phone = $_POST['b_phone'];

    if (empty($branch_name) || empty($b_address) || empty($b_phone)) {
        echo "Please fill in all fields";
    } else {
        $sql = "UPDATE branch SET b_name = :b_name, b_address = :b_address, b_phone = :b_phone WHERE b_id = :b_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':b_id', $b_id);
        $stmt->bindParam(':b_name', $branch_name); // Update the variable name
        $stmt->bindParam(':b_address', $b_address);
        $stmt->bindParam(':b_phone', $b_phone);

        if ($stmt->execute()) {
            echo '<script>alert("Branch updated successfully!");</script>';
        } else {
            echo "Error updating data: " . $stmt->errorInfo()[2];
        }
        $branches = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Redirect to the users list page
        echo '<script>window.location.href = "viewBranch.php";</script>';
        exit;
    }
}


?>
<?php
include("footer.php");
?>