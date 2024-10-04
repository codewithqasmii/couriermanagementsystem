<?php
session_start();
?>

<?php
include("connection.php");
?>

<?php
include("header.php");
?>

<?php

if (isset($_POST['submit'])) {
    $b_city = $_POST['b_city'];

    // Insert data into the "city" table
    try {
        $stmt = $conn->prepare("INSERT INTO city (name) VALUES (:b_city)");
        $stmt->bindParam(':b_city', $b_city);
        $stmt->execute();

        // Set a variable to hold the success message
        $success = "City registered successfully!";
    } catch (PDOException $e) {
        $error = "Error registering city: " . $e->getMessage();
    }
}
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-6">

            <form action="" method="post">
                <h1 class="text-center mt-5 text-danger">Register City</h1>
                <!-- show error or success message -->
                <div class="d-flex justify-content-center ">
                    <?php if (isset($success) && !empty($success)): ?>
                        <h6 class="btn btn-success" id="success">
                            <?php echo $success; ?>
                        </h6>
                    <?php elseif (isset($error) && !empty($error)): ?>
                        <h6 class="btn btn-danger" id="error">
                            <?php echo $error; ?>
                        </h6>
                    <?php else: ?>
                        <!-- If no error or success, display a transparent button -->
                        <h6 class="btn btn-transparent" id="error" style="visibility: hidden;">
                            <!-- No content needed here -->
                        </h6>
                    <?php endif; ?>
                </div>

                <div class="form-group mt-3">
                    <label>City:</label>
                    <input class="form-control" type="text" name="b_city" placeholder="Enter City Name" require pattern="[a-zA-Z0-9]{5,}" title="minimum 5 digits">
                </div>
                <button type="submit" name="submit" class="btn btn-danger mt-2">Register</button>



        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include("footer.php");

?>