


<?php
session_start();
?>
<?php
include('connection.php');
?>

<?php
include("header.php");
?>

<!-- Blank Start -->
<div class="container">
    <div class="row min-vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">
            <div class="container mt-3">
                <h2>Agents Parcels List</h2>
                <!-- Add a search form above the table -->
                <?php



$stmt = $conn->prepare("SELECT 
                            p.agent_name, 
                            COUNT(CASE WHEN s.name = 'delivered' THEN 1 END) as total_delivered_parcels,
                            COUNT(CASE WHEN s.name = 'received' THEN 1 END) as total_receive_parcels,
                            COUNT(CASE WHEN s.name = 'on the way' THEN 1 END) as total_on_the_way,
                            COUNT(CASE WHEN s.name = 'returned' THEN 1 END) as total_returned_parcels,
                            COUNT(CASE WHEN s.name = 'pending' THEN 1 END) as total_pending_parcels,
                            COUNT(p.id) as total_parcels
                        FROM parcels p
                        INNER JOIN status s ON p.status = s.id
                        GROUP BY p.agent_name");

$stmt->execute();

$agent_parcels = $stmt->get_result();

if ($agent_parcels->num_rows > 0) {
    // Display agent total parcels in a table
?>
    <table class="table table-striped">
        <thead>
            <tr>
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
            while ($row = $agent_parcels->fetch_assoc()) {
                $agent_name = $row['agent_name'];
                $total_parcels = $row['total_parcels'];
                $total_delivered_parcels = $row['total_delivered_parcels'];
                $total_receive_parcels = $row['total_receive_parcels'];
                $total_on_the_way = $row['total_on_the_way'];
                $total_returned_parcels = $row['total_returned_parcels'];
                $total_pending_parcels = $row['total_returned_parcels'];
                echo "<tr>";
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
<?php
} else {
    echo "No results found";
}
?>

            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php
include("footer.php");
?>







