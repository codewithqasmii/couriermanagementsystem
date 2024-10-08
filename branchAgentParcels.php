<?php
session_start();
// Database connection
include("connection.php");
include("header.php");

// Get the branch name from the GET request
$branch_name = $_GET['branch_name'];

// SQL query to retrieve the agent details
$sql = "SELECT 
            u.branch_name, 
            p.agent_name, 
            COUNT(CASE WHEN s.name = 'delivered' THEN 1 END) as total_delivered_parcels,
            COUNT(CASE WHEN s.name = 'received' THEN 1 END) as total_receive_parcels,
            COUNT(CASE WHEN s.name = 'on the way' THEN 1 END) as total_on_the_way,
            COUNT(CASE WHEN s.name = 'returned' THEN 1 END) as total_returned_parcels,
            COUNT(CASE WHEN s.name = 'pending' THEN 1 END) as total_pending_parcels,
            COUNT(p.id) as total_parcels
        FROM parcels p
        INNER JOIN status s ON p.status = s.id
        INNER JOIN users u ON p.agent_name = u.uname
        WHERE u.branch_name = :branch_name
        GROUP BY u.branch_name, p.agent_name";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':branch_name', $branch_name);
$stmt->execute();

if ($stmt->errorCode() != '00000') {
    echo "Error executing query: " . $stmt->errorInfo()[2];
    exit;
}

$agent_parcels = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($agent_parcels) > 0) {
    // Display agent total parcels in a table
?>
    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light justify-content-center mx-0">
            <div class="col-md-12 text-center ">
                <h1 class="text-center text-danger mt-5">Branch Detail </h1>
                <a href="branchAgent.php" class="btn btn-danger float-end">Back</a>

                <!-- <h3 class="text-danger mt-5"><?php echo "<td>$branch_name Branch</td>"; ?></h3> -->
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h3 class="text-danger mt-5"><?php echo "$branch_name Branch"; ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <!-- <th>Branch Name</th> -->
                            <th>Agent Name</th>
                            <th>Total Parcels</th>
                            <th>Total Delivered</th>
                            <th>Total Received</th>
                            <th>Total On the Way</th>
                            <th>Total Returned</th>
                            <th>Total Pending</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($agent_parcels as $row) {
                            $branch_name = $row['branch_name'];
                            $agent_name = $row['agent_name'];
                            $total_parcels = $row['total_parcels'];
                            $total_delivered_parcels = $row['total_delivered_parcels'];
                            $total_receive_parcels = $row['total_receive_parcels'];
                            $total_on_the_way = $row['total_on_the_way'];
                            $total_returned_parcels = $row['total_returned_parcels'];
                            $total_pending_parcels = $row['total_pending_parcels'];
                            echo "<tr>";
                            // echo "<td>$branch_name</td>";
                            echo "<td>$agent_name</td>";
                            echo "<td>$total_parcels</td>";
                            echo "<td>$total_delivered_parcels</td>";
                            echo "<td>$total_receive_parcels</td>";
                            echo "<td>$total_on_the_way</td>";
                            echo "<td>$total_returned_parcels</td>";
                            echo "<td>$total_pending_parcels</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <button class="btn btn-success float-end" onclick="downloadExcel()">Download Excel</button>


            </div>
        </div>
    </div>
    <!-- Blank End -->




<?php
} else {
    ?>
    <!-- Blank Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row vh-100 bg-light justify-content-center mx-0">
            <div class="col-md-12 text-center ">
                <h1 class="text-center text-danger mt-5">Branch Detail </h1>
                <a href="branchAgent.php" class="btn btn-danger float-end">Back</a>

                <!-- <h3 class="text-danger mt-5"><?php echo "<td>$branch_name Branch</td>"; ?></h3> -->
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h3 class="text-danger mt-5"><?php echo "$branch_name Branch"; ?></h3>
                            </td>
                        </tr>
                        <tr>
                            <!-- <th>Branch Name</th> -->
                            <th>Agent Name</th>
                            <th>Total Parcels</th>
                            <th>Total Delivered</th>
                            <th>Total Received</th>
                            <th>Total On the Way</th>
                            <th>Total Returned</th>
                            <th>Total Pending</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                            <p class="text-danger mt-5">No Agents / Parcels found for this branch.</p>
            </div>
        </div>
    </div>
    <!-- Blank End -->
    <?php
}


include("footer.php")
?>


<script>
    function downloadExcel() {
        var table = document.getElementById('table');
        var rows = table.rows;
        var csv = '';
        for (var i = 0; i < rows.length; i++) {
            var row = '';
            var cols = rows[i].cells;
            for (var j = 0; j < cols.length; j++) {
                if (cols[j].tagName !== 'H3') {
                    row += cols[j].textContent + ',';
                }
            }
            csv += row + '\n';
        }
        var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
        var link = document.createElement('a');
        link.href = csvData;
        link.target = '_blank';
        link.download = 'branch_details_' + new Date().toISOString().replace(/:/g, '-') + '.csv';
        link.click();
    }
</script>