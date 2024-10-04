<?php
session_start();
?>
<?php
include("connection.php");
?>

<?php

// remaining code in sendMessageTrackId

// if (isset($_POST['submit'])) {
//     date_default_timezone_set('Asia/karachi');

//     // Check if all required variables are set
//     if (isset($_POST['sendername']) && isset($_POST['senderaddress']) && isset($_POST['sendercontact']) && isset($_POST['recipentname']) && isset($_POST['recipentaddress']) && isset($_POST['recipentcontact']) && isset($_POST['weight']) && isset($_POST['price']) && isset($_POST['status'])) {
//         // Generate a 10-digit track ID
//         $track_id = rand(1000000, 9999999); // 10-digit random number

//         // Define the SQL query with placeholders
//         $stmt = $conn->prepare("INSERT INTO parcels (track_id, sender_name, sender_address, sender_contact, recipent_name, recipent_address, recipent_contact, weight, price, status, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

//         // Define the variables
//         $track_id = $track_id;
//         $sender_name = $_POST['sendername'];
//         $sender_address = $_POST['senderaddress'];
//         $sender_contact = $_POST['sendercontact'];
//         $recipent_name = $_POST['recipentname'];
//         $recipent_address = $_POST['recipentaddress'];
//         $recipent_contact = $_POST['recipentcontact'];
//         $weight = $_POST['weight'];
//         $price = $_POST['price'];
//         $status = $_POST['status'];
//         $date = date('Y-m-d h:i:s');

//         // Bind the variables to the placeholders
//         $stmt->bind_param("sssssssssss", $track_id, $sender_name, $sender_address, $sender_contact, $recipent_name, $recipent_address, $recipent_contact, $weight, $price, $status, $date);

//         // Execute the query
//         $stmt->execute();

//         if ($stmt->affected_rows > 0) {
//             // Send SMS using an SMS gateway API
//             $message = "Your track ID is $track_id";
//             // Replace with your SMS gateway API credentials and function
//             echo "<script>alert('Courier Added your id and SMS sent');</script>";
//         } else {
//             echo "<script>alert('Error adding courier');</script>";
//         }
//     } else {
//         echo "<script>alert('Please fill in all required fields');</script>";
//     }
// }
// ?>



<?php
include("header.php")
?>


<div class="container">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-12">
            <div class="container mt-3">
                <div class="container mt-3 w-100 align-middle">
                    <h2 class="text-center text-primary">Add Courier</h2>
                    <form action="sendMessageTrackId.php" method="post">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>Date:</label>
                                <input type="date" class="form-control" placeholder="Date" name="date">
                            </div>
                            <div class="col-12 col-md-4">
                                <!-- <label>Refrence Number:</label> -->
                                <input type="hidden" class="form-control" placeholder="Refrence Number" name="track_id">
                            </div>

                        </div>
                        <h3 class="mt-3 text-primary">Sender Details</h3>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>Sender Name</label>
                                <input type="text" class="form-control" placeholder="Sender Name" name="sendername">
                            </div>

                            <div class="col-12 col-md-4">
                                <label>Sender Address:</label>
                                <input type="text" class="form-control" placeholder="Sender Address" name="senderaddress">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Sender Contact</label>
                                <input type="number" class="form-control" placeholder="Sender Contact" name="sendercontact">
                            </div>
                        </div>
                        <h3 class="mt-3 text-primary">Recipent Details</h3>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>Recipent Name:</label>
                                <input type="text" class="form-control" placeholder="Recipent Name" name="recipentname">
                            </div>
                            <div class="col-12 col-md-4">
                                <label">Recipent Address</label>
                                <input type="text" class="form-control" placeholder="Recipent Name" name="recipentaddress">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Recipent Contact:</label>
                                <input type="number" class="form-control" placeholder="Recipent Contact" name="recipentcontact">
                            </div>

                        </div>
                        <div class="row mt-3">
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-4">
                                <label>Weight</label>
                                <input type="text" class="form-control" placeholder="Weight" name="weight">
                            </div>

                            <div class="col-12 col-md-4">
                                <label>Price:</label>
                                <input type="number" class="form-control" placeholder="Price" name="price">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="pwd">Status:</label>
                                <select class="form-control" name="status" required>
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="1">Recieved</option>
                                    <option value="2">On the way</option>
                                    <option value="3">Pending</option>
                                    <option value="4">Delivered</option>
                                    <option value="5">Returned</option>
                                    <!-- <option value="user">User</option> -->
                                </select>
                            </div>

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-3">Add Courier</button>



                    </form>
                    <!-- <form method="post">
                        <div class="mb-3 mt-3">
                            <label for="email">Username:</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter username" name="uname" required>
                        </div>
                        <div class="mb-3">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="upwd" required>
                        </div>

                        <div class="mb-3">
                            <label for="pwd">Role:</label>
                            <select class="form-control" name="role" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="agent">Agent</option>
                            </select>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Register</button>

                    </form> -->
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Blank End -->


<?php
include("footer.php")
?>