<?php
// include("query.php");
include('connection.php');
include("header.php");

?>

<!-- total users -->
<?php
$sql = "SELECT COUNT(*) as total_users
        FROM users
        WHERE role = 'user'";

$users = $conn->query($sql);

if ($users->num_rows > 0) {
    $row = $users->fetch_assoc();
    $total_users = $row['total_users'];
}
?>

<!-- total agents -->
<?php
$sql = "SELECT COUNT(*) as total_agents
        FROM users
        WHERE role = 'agent'";

$agents = $conn->query($sql);

if ($agents->num_rows > 0) {
    $row = $agents->fetch_assoc();
    $total_agents = $row['total_agents'];
}
?>
<!-- total parcels -->
<?php
$sql = "SELECT COUNT(*) as total_parcels
        FROM parcels";

$total_parcels = $conn->query($sql);

if ($total_parcels->num_rows > 0) {
    $row = $total_parcels->fetch_assoc();
    $total_parcels_count = $row['total_parcels'];
}
?>

<!-- total returned parcels -->
<?php
$sql = "SELECT COUNT(*) as total_returned_parcels
        FROM parcels
        INNER JOIN status ON parcels.status = status.id
        WHERE status.name = 'returned'";

$returned_parcels = $conn->query($sql);

if ($returned_parcels->num_rows > 0) {
    $row = $returned_parcels->fetch_assoc();
    $total_returned_parcels = $row['total_returned_parcels'];
}
?>

<!-- total delivered parcels -->
<?php
$sql = "SELECT COUNT(*) as total_delivered_parcels
        FROM parcels
        INNER JOIN status ON parcels.status = status.id
        WHERE status.name = 'delivered'";

$delivered_parcels = $conn->query($sql);

if ($delivered_parcels->num_rows > 0) {
    $row = $delivered_parcels->fetch_assoc();
    $total_delivered_parcels = $row['total_delivered_parcels'];
}
?>
<!-- total pending parcels -->
<?php
$sql = "SELECT COUNT(*) as total_pending_parcels
        FROM parcels
        INNER JOIN status ON parcels.status = status.id
        WHERE status.name = 'pending'";

$pending_parcels = $conn->query($sql);

if ($pending_parcels->num_rows > 0) {
    $row = $pending_parcels->fetch_assoc();
    $total_pending_parcels = $row['total_pending_parcels'];
}
?>
<!-- total received parcels -->
<?php
$sql = "SELECT COUNT(*) as total_receive_parcels
        FROM parcels
        INNER JOIN status ON parcels.status = status.id
        WHERE status.name = 'received'";

$receive_parcels = $conn->query($sql);

if ($receive_parcels->num_rows > 0) {
    $row = $receive_parcels->fetch_assoc();
    $total_receive_parcels = $row['total_receive_parcels'];
}
?>
<!-- total ON THE WAY parcels -->
<?php
$sql = "SELECT COUNT(*) as total_onway_parcels
        FROM parcels
        INNER JOIN status ON parcels.status = status.id
        WHERE status.name = 'on the way'";

$way_parcels = $conn->query($sql);

if ($way_parcels->num_rows > 0) {
    $row = $way_parcels->fetch_assoc();
    $total_way_parcels = $row['total_onway_parcels'];
}
?>

<!-- Blank Start -->
<div class="container">
    <div class="row h-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-12">
            <div class="container text-center mt-3">
                <div class="container mt-3 w-100 align-middle">
                    
<div class="row justify-content-center">
    <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-3">
        <canvas id="total-users-chart" width="300px" height="300px"></canvas>
    </div>
    <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-3">
        <canvas id="total-agents-chart" width="300px" height="300px"></canvas>
    </div>
    <div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-3">
        <canvas id="total-parcels-chart" width="300px" height="300px"></canvas>
    </div>
</div>


<script>
    window.onload = function() {
        // Total Users Pie Chart
        var totalUsersCanvas = document.getElementById('total-users-chart');
        var totalUsersCtx = totalUsersCanvas.getContext('2d');

        var totalUsersData = {
            labels: ['Users'],
            datasets: [{
                label: 'Total Users',
                data: [<?php echo $total_users; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        var totalUsersChart = new Chart(totalUsersCtx, {
            type: 'pie',
            data: totalUsersData,
            options: {
                title: {
                    display: true,
                    text: 'Total Users'
                }
            }
        });

        // Total Agents Pie Chart
        var totalAgentsCanvas = document.getElementById('total-agents-chart');
        var totalAgentsCtx = totalAgentsCanvas.getContext('2d');

        var totalAgentsData = {
            labels: ['Agents'],
            datasets: [{
                label: 'Total Agents',
                data: [<?php echo $total_agents; ?>],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        var totalAgentsChart = new Chart(totalAgentsCtx, {
            type: 'pie',
            data: totalAgentsData,
            options: {
                title: {
                    display: true,
                    text: 'Total Agents'
                }
            }
        });

        // Total Parcels with Status Pie Chart
        var totalParcelsCanvas = document.getElementById('total-parcels-chart');
        var totalParcelsCtx = totalParcelsCanvas.getContext('2d');

        var totalParcelsData = {
            labels: ['Received', 'On the Way', 'Delivered', 'Pending', 'Returned'],
            datasets: [{
                label: 'Total Parcels',
                data: [<?php echo $total_receive_parcels; ?>, <?php echo $total_way_parcels; ?>, <?php echo $total_delivered_parcels; ?>, <?php echo $total_pending_parcels; ?>, <?php echo $total_returned_parcels; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        var totalParcelsChart = new Chart(totalParcelsCtx, {
            type: 'pie',
            data: totalParcelsData,
            options: {
                title: {
                    display: true,
                    text: 'Total Parcels with Status'
                }
            }
        });
    }
</script>
                
<div class="row">

                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"> <span class="text-danger">Total</span> Users</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_users}  <span class='text-success'>Users</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users text-danger" style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"><span class="text-danger">Total</span> Agents</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_agents}  <span class='text-success'>Agents</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-secret text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"> <span class="text-danger">Total</span> Parcels</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_parcels_count}  <span class='text-success'>Parcels</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"> <span class="text-danger">Total</span> Received</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_receive_parcels}  <span class='text-success'>Received</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger" style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"><span class="text-danger">Total</span> On the Way</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_way_parcels}  <span class='text-success'>On the Way</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"> <span class="text-danger">Total</span> Delivered</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_delivered_parcels} <span class='text-success'>Delivered</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>



                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"> <span class="text-danger">Total</span> Pending</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_pending_parcels}  <span class='text-success'>Pending</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger" style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"><span class="text-danger">Total</span> Returned</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_returned_parcels}  <span class='text-success'>Returned</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h2 class="text-primary"><span class="text-danger">Total</span> Returned</h2>
                                    <?php echo "<h3 class='text-danger'>{$total_returned_parcels}  <span class='text-success'>Returned</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>


<!-- this php code is commited -->
                     <!-- <?php
                        $stmt = $conn->prepare("SELECT agent_name, COUNT(id) as total_parcels
                        FROM parcels
                        GROUP BY agent_name");

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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $agent_parcels->fetch_assoc()) {
                                        $agent_name = $row['agent_name'];
                                        $total_parcels = $row['total_parcels'];
                                        echo "<tr>";
                                        echo "<td>$agent_name</td>";
                                        echo "<td>$total_parcels</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                            echo "No results found";
                        }
                        ?> -->





                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Blank End -->


<?php
include("footer.php");
?>