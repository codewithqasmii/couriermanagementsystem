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
    $b_name = $_POST['b_name'];
    $b_address = $_POST['b_address'];
    $b_phone = $_POST['b_phone'];
    $b_city = $_POST['b_city'];

    // Insert data into the "branch" table
    try {
        $stmt = $conn->prepare("INSERT INTO branch (b_name, b_address, b_phone, b_city) VALUES ( :b_name, :b_address, :b_phone, :b_city)");
        $stmt->bindParam(':b_name', $b_name);
        $stmt->bindParam(':b_address', $b_address);
        $stmt->bindParam(':b_phone', $b_phone);
        $stmt->bindParam(':b_city', $b_city);
        $stmt->execute();

        // Set a variable to hold the success message
        $success = "Branch registered successfully!";
    } catch (PDOException $e) {
        $error = "Error registering branch: " . $e->getMessage();
    }
}

?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-6">

            <form action="" method="post">
                <h1 class="text-center mt-5 text-danger">Register Branch</h1>
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
    <label for="city">City:</label>
    <select class="form-control" name="b_city" id="city" required>
        <option value="" disabled selected>Select City</option>
        <?php
        $sql = "SELECT DISTINCT name FROM city";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
        }
        ?>
    </select>
</div>                          <div class="form-group mt-3">
                    <label>Branch Name:</label>
                    <input class="form-control" type="text" name="b_name" placeholder="Enter Branch Name" require pattern="(?=.*[a-zA-Z0-9])[a-zA-Z0-9 ]{5,}" title="minimum 5 characters">
                </div>

                <div class="form-group mt-3">
                    <label>Branch Address:</label>
                    <input class="form-control" type="text" name="b_address" placeholder="Enter Branch Address" required pattern="(?=.*[a-zA-Z0-9])[a-zA-Z0-9 ]{5,}" title="minimum 5 characters">
                </div>
                <div class="form-group mt-3">
                    <label>Branch Phone No.:</label>
                    <input class="form-control" type="tel" name="b_phone" placeholder="Enter Branch Phone Number" required minlength="10" title="minimum 10 digits">
                </div>

                <button type="submit" name="submit" class="btn btn-danger mt-2">Register</button>



        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include("footer.php");

?>