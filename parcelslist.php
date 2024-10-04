<?php
session_start();
?>
<?php
include("connection.php");
?>

<?php
include("header.php");
?>

<!-- Blank Start -->
<div class="container">
    <div class="row min-vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">
            <div class="container mt-3">
                <h2>Parcels List</h2>
                <!-- Add a search form above the table -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input type="text" name="search" placeholder="Search by Track ID">
                    <button type="submit">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Track Id</th>
                                <th>Sender Name</th>
                                <th>Sender Address</th>
                                <th>Sender Contact</th>
                                <th>Reciever Name</th>
                                <th>Reciever Address</th>
                                <th>Reciever Contact</th>
                                <th>Weight</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Book BY</th>
                                <th>Date</th>
                                <th>show</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (isset($_GET['search'])) {
                                $search = $_GET['search'];
                                $sql = "SELECT * FROM parcels WHERE track_id LIKE '%$search%'";
                            } else {
                                $sql = "SELECT * FROM parcels";
                            }

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($result) == 0) {
                            ?>
                                <script>
                                    alert("No tracking ID found!");
                                    window.location.href = "parcelslist.php";
                                </script>
                                <?php
                            } else {
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
                                                <a href="editParcel.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                    Edit
                                                </a>
                                            </button>
                                        </td>

                                        <td>
                                            <button class="btn btn-danger border-0">
                                                <a href="deleteParcel.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;" onclick="return confirm('Are you sure you want to delete this parcel?')">Delete</a> </button>
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
        printWindow.document.write('<td>Date: ' + row.cells[12].innerHTML + '</td>');
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
        printWindow.document.write('<p>Book By: ' + row.cells[11].innerHTML + '</p>'); // Add book by field
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