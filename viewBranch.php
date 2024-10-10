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
                <a href="viewBranch.php"><button class="btn btn-danger float-right">back</button></a>
                <h2 class="text-danger mt-3 mb-3">Branch List</h2>
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="mb-5">
                    <select name="search" id="search">
                        <option value="">Select a branch</option>
                        <?php
                        $sql = "SELECT b_name FROM branch";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($result as $data) {
                        ?>
                            <option value="<?php echo $data['b_name']; ?>"><?php echo $data['b_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-danger">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <!-- <th>Branch ID</th> -->
                                <th>Branch city</th>
                                <th>Branch Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Action</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            if (isset($_GET['search'])) {
                                $search = $_GET['search'];
                                $sql = "SELECT * FROM branch WHERE b_name LIKE '%$search%'";
                            } else {
                                $sql = "SELECT * FROM branch";
                            }

                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($result) == 0) {
                            ?>
                                <script>
                                    alert("No branch found!");
                                    window.location.href = "viewBranch.php";
                                </script>
                                <?php
                            } else {
                                $i = 1;
                                foreach ($result as $data) {
                                ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <!-- <td><?php echo $data['b_id']; ?></td> -->
                                        <td><?php echo $data['b_city']; ?></td>
                                        <td><?php echo $data['b_name']; ?></td>
                                        <td><?php echo $data['b_address']; ?></td>
                                        <td><?php echo $data['b_phone']; ?></td>
                                        <td>
                                            <button class="btn btn-success border-0">
                                                <a href="editBranch.php?id=<?php echo $data['b_id']; ?>" style="text-decoration: none; color: black;">
                                                    Edit
                                                </a>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger border-0">
                                                <a href="deleteBranch.php?id=<?php echo $data['b_id']; ?>" style="text-decoration: none; color: black;" onclick="return confirm('Are you sure you want to delete this branch?')">Delete</a>
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

<!-- function for print -->

<script>
    function printRow(button) {
        var row = button.parentNode.parentNode;
        var table = row.parentNode;
        var rows = table.rows;
        var index = Array.prototype.indexOf.call(rows, row);

        var printWindow = window.open('', 'Print Row', 'width=800,height=600');
        printWindow.document.write('<html><head><title>Print Row</title><style>table, th, td { border: 1px solid black; border-collapse: collapse; padding: 5px; }</style></head><body>');
        printWindow.document.write("<div style='display: flex; justify-content: center; align-items: center;'>");
        printWindow.document.write("<img src='img/logo.png' style='width: 100px; height: 100px; margin-right: 20px;'/>");
        printWindow.document.write("<h1 style='color: red;'>CMS</h1>");
        printWindow.document.write("</div>");



        printWindow.document.write('<table style="margin: 0 auto;">');
        printWindow.document.write('<thead style="background-color:grey;">');
        printWindow.document.write('<tr>');
        printWindow.document.write('<th>Sr.No</th>');
        printWindow.document.write('<th>Branch ID</th>');
        printWindow.document.write('<th>Branch Name</th>');
        printWindow.document.write('<th>Address</th>');
        printWindow.document.write('<th>Contact</th>');
        printWindow.document.write('</tr>');
        printWindow.document.write('</thead>');

        printWindow.document.write('<tr>');
        for (var i = 0; i < row.cells.length && i < 5; i++) {
            printWindow.document.write('<td>' + row.cells[i].innerHTML + '</td>');
        }
        printWindow.document.write('</tr>');
        printWindow.document.write('</table>');
        printWindow.document.write('</body></html>');
        printWindow.print();
    }
</script>