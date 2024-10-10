<?php
session_start();
?>
<?php
include("connection.php");
?>

<?php
include("includes/agentheader.php");
?>

<!-- Blank Start -->
<div class="container">
    <div class="row min-vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">

        <div>
    <h1 class="mb-5 mt-4 text-danger">Parcels List</h1>
    <div class="mb-5 d-flex justify-content-between">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="mb-4">
            <!-- form fields here -->
        </form>
        <a href="parcelslistAgent.php" class="btn btn-danger">Back</a>
    </div>

    <div class="d-flex justify-content-around flex-wrap">                
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="mb-4">
                    <input type="text" name="search" placeholder="Search by Track ID">
                    <select name="status">
                        <option value="">All Statuses</option>
                        <option value="1">Recieved</option>
                        <option value="2">On the Way</option>
                        <option value="3">Pending</option>
                        <option value="4">Delivered</option>
                        <option value="5">Returned</option>
                    </select>
                    <button type="submit" class="btn btn-danger">Search</button>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Track Id</th>
                                <th>Sender Name</th>
                                <th>Sender Address</th>
                                <th>Sender Contact</th>
                                <th>Reviever Name</th>
                                <th>Reciever Address</th>
                                <th>Reciever Contact</th>
                                <th>Weight</th>
                                <th>Price</th>
                                <th>status</th>
                                <th>Agent</th>
                                <th>Date</th>
                                <th>Action</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
// Check if a search parameter is set
if (isset($_GET['search']) || isset($_GET['status'])) {
    // If a search parameter is set, modify the SQL query to include the search condition
    $sql = "SELECT * FROM parcels WHERE agent_name = ?";

    if (isset($_GET['search'])) {
        $sql .= " AND track_id LIKE ?";
    }

    if (isset($_GET['status']) && $_GET['status'] != '') {
        $sql .= " AND status = ?";
    }

    $stmt = $conn->prepare($sql); // Prepare the new statement

    $stmt->bindValue(1, $_SESSION['username']);

    $i = 2;
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $stmt->bindValue($i, '%' . $search . '%'); // Bind the parameters
        $i++;
    }

    if (isset($_GET['status']) && $_GET['status'] != '') {
        $stmt->bindValue($i, $_GET['status']); // Bind the parameters
    }
} else {
    // If no search parameter is set, use the original SQL query
    $sql = "SELECT * FROM parcels WHERE agent_name = ?";
    $stmt = $conn->prepare($sql); // Prepare the new statement
    $stmt->bindValue(1, $_SESSION['username']); // Bind the parameter
}

// Check if the statement is prepared successfully
if ($stmt) {
    // Execute the statement
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Error preparing statement";
}

// Check if any results were found
if (count($result) > 0) {
    // Fetch and display the results
    $i = 1;
    foreach ($result as $data) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['track_id']; ?></td>
            <td><?php echo $data['sender_name']; ?></td>
            <td><?php echo $data['sender_address']; ?></td>
            <td><?php echo $data['sender_contact']; ?></td>
            <td><?php echo $data['recipent_name']; ?></td>
            <td><?php echo $data['recipent_address']; ?></td>
            <td><?php echo $data['recipent_contact']; ?></td>
            <td><?php echo $data['weight']; ?></td>
            <td><?php echo $data['price']; ?></td>
            <td><?php echo $data['status']; ?></td>

                                        <td><?php echo $data['agent_name']; ?></td>
                                        <td><?php echo $data['date']; ?></td>
                                        <td>
                                            <button class="btn btn-success border-0">
                                                <a href="editParcelsAgent.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                    Edit
                                                </a>
                                            </button>
                                        </td>

                                        <td>
                                            <button class="btn btn-primary border-0" onclick="printRow(this)">
                                                <i class="fa fa-print text-white" style="font-size: 20px;"></i>

                                            </button>
                                        </td>

                                        <!-- <td>
                                        <button class="btn btn-danger border-0">
                                            <a href="deleteParcel.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                Delete
                                            </a>
                                        </button>
                                    </td> -->
                                    </tr>

                            <?php
                                    $i++;
                                }
                            } else {
                                // If no results were found, display an alert message

                                echo "<script>alert('No results found for selected ID or Status .'); window.location.href='parcelslistAgent.php';</script>";
                            }


                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php
include("footer.php");
?>

<!-- fucntion for pirnt -->

<script>
    function printRow(button) {
        var row = button.parentNode.parentNode;
        var table = row.parentNode;
        var rows = table.rows;
        var index = Array.prototype.indexOf.call(rows, row);

        var printWindow = window.open('', 'Print Row', 'width=800,height=600');
        printWindow.document.write('<html><head><title>Parcel Receipt</title><style>table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }</style></head><body>');
        printWindow.document.write('<img src="img/logo.png" alt="CMS Logo" style="width: 150px; display: block; margin: 0 auto;">');
        printWindow.document.write('<h1 style="text-align: center;">CMS - Parcel Receipt</h1>'); // add CMS heading

        printWindow.document.write('<table style="margin: 0 auto;">');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>Date: ' + row.cells[11].innerHTML + '</td>');
        printWindow.document.write('</tr>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>Track ID: ' + row.cells[1].innerHTML + '</td>');
        printWindow.document.write('</tr>');


        printWindow.document.write('<tr><th>Sender Details</th></tr>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>');
        printWindow.document.write('<p>Sender Name: ' + row.cells[2].innerHTML + '</p>');
        printWindow.document.write('<p>Sender Address: ' + row.cells[3].innerHTML + '</p>');
        printWindow.document.write('<p>Sender Contact: ' + row.cells[4].innerHTML + '</p>');
        printWindow.document.write('</td>');
        printWindow.document.write('</tr>');

        printWindow.document.write('<tr><th>Reciever Details</th></tr>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>');
        printWindow.document.write('<p>Reciever Name: ' + row.cells[5].innerHTML + '</p>');
        printWindow.document.write('<p>Reciever Address: ' + row.cells[6].innerHTML + '</p>');
        printWindow.document.write('<p>Reciever Contact: ' + row.cells[7].innerHTML + '</p>');
        printWindow.document.write('</td>');
        printWindow.document.write('</tr>');

        printWindow.document.write('<tr><th>Parcel Details</th></tr>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>');
        printWindow.document.write('<p>Weight: ' + row.cells[8].innerHTML + '</p>');
        printWindow.document.write('<p>Total Price: ' + row.cells[9].innerHTML + '</p>');
        printWindow.document.write('<p>Book By: ' + row.cells[10].innerHTML + '</p>'); // Add book by field
        printWindow.document.write('</td>');
        printWindow.document.write('</tr>');

        printWindow.document.write('<tr>');
        printWindow.document.write('<td>');
        var currentDate = new Date();
        printWindow.document.write('</td>');
        printWindow.document.write('</tr>');

        printWindow.document.write('<tr>');
        printWindow.document.write('<td>');
        printWindow.document.write('<p>Receiver Signature: ______________________</p>');
        printWindow.document.write('</td>');
        printWindow.document.write('</tr>');
        printWindow.document.write('<tr>');
        printWindow.document.write('<td>');
        printWindow.document.write('<p>Thanks for using CMS courier services.</p>');
        printWindow.document.write('</td>');
        printWindow.document.write('</tr>');

        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');
        setTimeout(function() {
            printWindow.print();
        }, 1000); // delay for 1 second
    }
</script>