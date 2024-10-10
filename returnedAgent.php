<?php
session_start();
include("connection.php");
include("includes/agentheader.php");
?>

<!-- Blank Start -->
<div class="container">
    <div class="row min-vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">

        <div>
                <h2 class="mb-5 mt-4">Returned Parcels List</h2>
                <div class="mb-5 text-right">
                    <a href="dashboard.php"><button class="btn btn-danger">Dashboard</button></a>
                    <a href="onthewayAgent.php"><button class="btn btn-danger">Back</button></a>
                </div>

                <div class="d-flex justify-content-around flex-wrap">
                    <!-- Search by Track ID -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                        <input type="text" name="search" placeholder="Search by Track ID">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </form>
            </div>

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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['search'])) {
                            $sql = "SELECT * FROM parcels WHERE agent_name = ? AND track_id LIKE ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(1, $_SESSION['username']);
                            $stmt->bindValue(2, '%' . $_GET['search'] . '%');
                        } else {
                            $sql = "SELECT * FROM parcels WHERE agent_name = ? AND status = 5";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindValue(1, $_SESSION['username']);
                        }

                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($result) > 0) {
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
                                </tr>
                        <?php
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='14' style='text-align: center; color:red;'>No results found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
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