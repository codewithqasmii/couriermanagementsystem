<?php
include("includes/agentheader.php");
?>
<?php
include("connection.php");
?>

<?php
// Total returned parcels
$stmt = $conn->prepare("SELECT COUNT(*) as total_returned_parcels
FROM parcels
INNER JOIN status ON parcels.status = status.id
WHERE status.name = 'returned' AND parcels.agent_name = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$result = $stmt->fetch();

$total_returned_parcels = $result['total_returned_parcels'] ?? 0;

// Total delivered parcels
$stmt = $conn->prepare("SELECT COUNT(*) as total_delivered_parcels
FROM parcels
INNER JOIN status ON parcels.status = status.id
WHERE status.name = 'delivered' AND parcels.agent_name = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$result = $stmt->fetch();

$total_delivered_parcels = $result['total_delivered_parcels'] ?? 0;

// Total pending parcels
$stmt = $conn->prepare("SELECT COUNT(*) as total_pending_parcels
FROM parcels
INNER JOIN status ON parcels.status = status.id
WHERE status.name = 'pending' AND parcels.agent_name = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$result = $stmt->fetch();

$total_pending_parcels = $result['total_pending_parcels'] ?? 0;

// Total received parcels
$stmt = $conn->prepare("SELECT COUNT(*) as total_receive_parcels
FROM parcels
INNER JOIN status ON parcels.status = status.id
WHERE status.name = 'received' AND parcels.agent_name = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$result = $stmt->fetch();

$total_receive_parcels = $result['total_receive_parcels'] ?? 0;

// Total ON THE WAY parcels
$stmt = $conn->prepare("SELECT COUNT(*) as total_onway_parcels
FROM parcels
INNER JOIN status ON parcels.status = status.id
WHERE status.name = 'on the way' AND parcels.agent_name = :username");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->execute();
$result = $stmt->fetch();

$total_onway_parcels = $result['total_onway_parcels'] ?? 0;
?>
<!-- Blank Start -->
<div class="container">
    <div class="row min-vh-100 bg-light rounded align-items-center justify-content-center mx-0 m-5">
        <div class="col-12">
            <div class="container text-center mt-3">
                <div class="container mt-3 w-100 align-middle">

                    <div class="row">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                                <canvas id="status-graph" width="600px" height="600px"></canvas>
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
                                    <?php echo "<h3 class='text-danger'>{$total_onway_parcels}  <span class='text-success'>On the Way</span></h3>"; ?>
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

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<script>
    window.onload = function() {
        var canvasElement = document.getElementById('status-graph');

        if (canvasElement === null) {
            console.error("Canvas element not found");
        } else {
            var ctx = canvasElement.getContext('2d');

            var data = {
                labels: ['Received', 'On the Way', 'Delivered', 'Pending', 'Returned'],
                datasets: [{
                    label: 'Graph',
                    data: [<?php echo $total_receive_parcels; ?>, <?php echo $total_onway_parcels; ?>, <?php echo $total_delivered_parcels; ?>, <?php echo $total_pending_parcels; ?>, <?php echo $total_returned_parcels; ?>],
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

            var chart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                    title: {
                        display: true,
                        text: 'Status Details'
                    },
                    plugins: {
                        datalabels: {
                            formatter: function(value, ctx) {
                                return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value;
                            },
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                }
            });
            console.log("Chart created");
        }
    }
</script>
