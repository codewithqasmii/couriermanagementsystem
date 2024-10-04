<?php
session_start();
// Connection
include("connection.php");
include("includes/agentheader.php");

// Validate and sanitize input data
if (isset($_POST['submit'])) {
    $trackid = $_POST['track_id'];
    $sname = $_POST['sendername'];
    $saddress = $_POST['senderaddress'];
    $scontact = $_POST['sendercontact'];
    $date = $_POST['date'];
    $recipentname = $_POST['recipentname'];
    $recipentaddress = $_POST['recipentaddress'];
    $recipentcontact = $_POST['recipentcontact'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $id = $_GET['id'];

    // Prepare the update query
    $stmt = $conn->prepare("UPDATE parcels SET track_id = :track_id, sender_name = :sender_name, sender_contact = :sender_contact, sender_address = :sender_address, date = :date, recipent_name = :recipent_name, recipent_address = :recipent_address, recipent_contact = :recipent_contact, weight = :weight, price = :price, status = :status WHERE id = :id");
    $stmt->bindParam(":track_id", $trackid);
    $stmt->bindParam(":sender_name", $sname);
    $stmt->bindParam(":sender_contact", $scontact);
    $stmt->bindParam(":sender_address", $saddress);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":recipent_name", $recipentname);
    $stmt->bindParam(":recipent_address", $recipentaddress);
    $stmt->bindParam(":recipent_contact", $recipentcontact);
    $stmt->bindParam(":weight", $weight);
    $stmt->bindParam(":price", $price);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    // Redirect to the users list page
    echo '<script>window.location.href = "parcelslistAgent.php";</script>';
    exit;
}

$parcelId = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM parcels WHERE id = :id");
$stmt->bindParam(":id", $parcelId);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$parcelData = $result;
?>



<div class="container">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-12">
            <div class="container mt-3">
                <div class="container mt-3 w-100 align-middle">
                    <h2 class="text-center">Edit Courier</h2>
                    <form method="post">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>Date:</label>
                                <input type="date" class="form-control" name="date" value="<?php echo $parcelData['date']; ?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <!-- <label>Refrence Number:</label> -->
                                <input type="hidden" class="form-control" name="track_id" value="<?php echo $parcelData['track_id']; ?>">
                            </div>

                        </div>
                        <h3 class="mt-3">Sender Details</h3>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>Sender Name</label>
                                <input type="text" class="form-control" name="sendername" value="<?php echo $parcelData['sender_name']; ?>">
                            </div>

                            <div class="col-12 col-md-4">
                                <label>Sender Address:</label>
                                <input type="text" class="form-control" name="senderaddress" value="<?php echo $parcelData['sender_address']; ?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Sender Contact</label>
                                <input type="number" class="form-control" name="sendercontact" value="<?php echo $parcelData['sender_contact']; ?>">
                            </div>
                        </div>
                        <h3 class="mt-3">Recipent Details</h3>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label>Recipent Name:</label>
                                <input type="text" class="form-control" name="recipentname" value="<?php echo $parcelData['recipent_name']; ?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Recipent Address</label>
                                <input type="text" class="form-control" name="recipentaddress" value="<?php echo $parcelData['recipent_address']; ?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label>Recipent Contact:</label>
                                <input type="number" class="form-control" name="recipentcontact" value="<?php echo $parcelData['recipent_contact']; ?>">
                            </div>

                        </div>
                        <div class="row mt-3">
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-md-4">
                                <label>Weight</label>
                                <input type="text" class="form-control" name="weight" value="<?php echo $parcelData['weight']; ?>">
                            </div>

                            <div class="col-12 col-md-4">
                                <label>Price:</label>
                                <input type="number" class="form-control" name="price" value="<?php echo $parcelData['price']; ?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="pwd">Status:</label>
                                <select class="form-control" name="status" required>
                                    <option value="" disabled>Select Status</option>
                                    <?php
                                    $statuses = array(
                                        '1' => 'Recieved',
                                        '2' => 'On the way',
                                        '3' => 'Pending',
                                        '4' => 'Delivered',
                                        '5' => 'Returned'
                                    );

                                    foreach ($statuses as $value => $label) {
                                        $selected = ($parcelData['status'] == $value) ? 'selected' : '';
                                        echo "<option value='$value' $selected>$label</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mt-2">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php
include("footer.php");
?>