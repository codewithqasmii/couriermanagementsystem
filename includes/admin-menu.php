<?php
include("connection.php");
?>
<?php
include("header.php");

// Total users
$sql = "SELECT COUNT(*) as total_users FROM users WHERE role = 'user'";
$users = $conn->query($sql);
$row = $users->fetch();
$total_users = $row['total_users'];

// Total agents
$sql = "SELECT COUNT(*) as total_agents FROM users WHERE role = 'agent'";
$agents = $conn->query($sql);
$row = $agents->fetch();
$total_agents = $row['total_agents'];

// Total branches
$sql = "SELECT COUNT(*) as total_branches FROM branch";
$branch = $conn->query($sql);
$row = $branch->fetch();
$total_branches = $row['total_branches'];


// Total parcels
$sql = "SELECT COUNT(*) as total_parcels FROM parcels";
$total_parcels = $conn->query($sql);
$row = $total_parcels->fetch();
$total_parcels_count = $row['total_parcels'];

// Total returned parcels
$sql = "SELECT COUNT(*) as total_returned_parcels 
        FROM parcels 
        INNER JOIN status ON parcels.status = status.id 
        WHERE status.name = 'returned'";
$returned_parcels = $conn->query($sql);
$row = $returned_parcels->fetch();
$total_returned_parcels = $row['total_returned_parcels'];

// Total delivered parcels
$sql = "SELECT COUNT(*) as total_delivered_parcels 
        FROM parcels 
        INNER JOIN status ON parcels.status = status.id 
        WHERE status.name = 'delivered'";
$delivered_parcels = $conn->query($sql);
$row = $delivered_parcels->fetch();
$total_delivered_parcels = $row['total_delivered_parcels'];

// Total pending parcels
$sql = "SELECT COUNT(*) as total_pending_parcels 
        FROM parcels 
        INNER JOIN status ON parcels.status = status.id 
        WHERE status.name = 'pending'";
$pending_parcels = $conn->query($sql);
$row = $pending_parcels->fetch();
$total_pending_parcels = $row['total_pending_parcels'];

// Total received parcels
$sql = "SELECT COUNT(*) as total_receive_parcels 
        FROM parcels 
        INNER JOIN status ON parcels.status = status.id 
        WHERE status.name = 'received'";
$receive_parcels = $conn->query($sql);
$row = $receive_parcels->fetch();
$total_receive_parcels = $row['total_receive_parcels'];

// Total ON THE WAY parcels
$sql = "SELECT COUNT(*) as total_onway_parcels 
        FROM parcels 
        INNER JOIN status ON parcels.status = status.id 
        WHERE status.name = 'on the way'";
$way_parcels = $conn->query($sql);
$row = $way_parcels->fetch();
$total_way_parcels = $row['total_onway_parcels'];
?>



<!-- Blank Start -->
<div class="container">
    <div class="row h-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-12">
            <div class="container text-center mt-3">
                <div class="container mt-3 w-100 align-middle">

                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-3 col-md-4 col-lg-3 mb-3">
                            <h6 class="text-danger">Users</h6>
                            <canvas id="total-users-chart" width="300px" height="300px"></canvas>
                        </div>
                        <div class="col-12 col-sm-3 col-md-4 col-lg-3 mb-3">
                            <h6 class="text-danger">Agents</h6>
                            <canvas id="total-agents-chart" width="300px" height="300px"></canvas>
                        </div>
                        <div class="col-12 col-sm-3 col-md-4 col-lg-3 mb-3">
                            <h6 class="text-danger">Branches</h6>
                            <canvas id="total-branch-chart" width="300px" height="300px"></canvas>
                        </div>
                        <div class="col-12 col-sm-3 col-md-4 col-lg-3 mb-3">
                            <h6 class="text-danger">Parcels</h6>
                            <canvas id="total-parcels-chart" width="300px" height="300px"></canvas>
                        </div>
                    </div>


                    <script>
                        window.onload = function() {
                            // Total Users Pie Chart
                            var totalUsersCanvas = document.getElementById('total-users-chart');
                            var totalUsersCtx = totalUsersCanvas.getContext('2d');

                            var totalUsersData = {
                                // labels : [''],
                                datasets: [{
                                    label: '',
                                    data: [],
                                    backgroundColor: [],
                                    borderColor: [],
                                    borderWidth: 1
                                }]
                            };

                            // Fetch the number of users for each individual user from the database
                            <?php
                            $stmt = $conn->prepare("SELECT id, uname FROM users WHERE role = 'user'");
                            $stmt->execute();
                            $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Generate random colors for each user
                            $colors = array();
                            foreach ($userData as $user) {
                                $colors[] = Color();
                            }

                            function Color()
                            {
                                $letters = '0123456789ABCDEF';
                                $color = '#';
                                for ($i = 0; $i < 6; $i++) {
                                    $color .= $letters[rand(0, 15)];
                                }
                                return $color;
                            }
                            ?>

                            // Populate the data for the pie chart
                            // totalUsersData.labels = <?php echo json_encode(array_column($userData, 'uname')); ?>;
                            totalUsersData.datasets[0].data = <?php echo json_encode(array_column($userData, 'id')); ?>;
                            totalUsersData.datasets[0].backgroundColor = <?php echo json_encode($colors); ?>;
                            totalUsersData.datasets[0].borderColor = <?php echo json_encode($colors); ?>;

                            var totalUsersChart = new Chart(totalUsersCtx, {
                                type: 'pie',
                                data: totalUsersData,
                                options: {
                                    title: {
                                        display: true,
                                    }
                                }
                            });
                            // Total Agents Pie Chart
                            var totalAgentsCanvas = document.getElementById('total-agents-chart');
                            var totalAgentsCtx = totalAgentsCanvas.getContext('2d');

                            var totalAgentsData = {
                                // labels: [''],
                                datasets: [{
                                    label: 'Total Agents',
                                    // data: [],
                                    backgroundColor: [],
                                    borderColor: [],
                                    borderWidth: 1
                                }]
                            };

                            // Fetch the number of agents for each individual agent from the database
                            <?php
                            $stmt = $conn->prepare("SELECT id, uname FROM users WHERE role = 'agent'");
                            $stmt->execute();
                            $agentData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Generate random colors for each agent
                            $colors = array();
                            foreach ($agentData as $agent) {
                                $colors[] = RandomColor();
                            }

                            function RandomColor()
                            {
                                $letters = '0123456789ABCDEF';
                                $color = '#';
                                for ($i = 0; $i < 6; $i++) {
                                    $color .= $letters[rand(0, 15)];
                                }
                                return $color;
                            }
                            ?>

                            // Populate the data for the pie chart
                            // totalAgentsData.labels = <?php echo json_encode(array_column($agentData, 'name')); ?>;
                            totalAgentsData.datasets[0].data = <?php echo json_encode(array_column($agentData, 'id')); ?>;
                            totalAgentsData.datasets[0].backgroundColor = <?php echo json_encode($colors); ?>;
                            totalAgentsData.datasets[0].borderColor = <?php echo json_encode($colors); ?>;

                            var totalAgentsChart = new Chart(totalAgentsCtx, {
                                type: 'pie',
                                data: totalAgentsData,
                                options: {
                                    title: {
                                        display: true,
                                        text: ''
                                    }
                                }
                            });

                            // Total Branches Pie Chart
                            var totalBranchesCanvas = document.getElementById('total-branch-chart');
                            var totalBranchesCtx = totalBranchesCanvas.getContext('2d');

                            var totalBranchesData = {
                                // labels: [''],
                                datasets: [{
                                    label: 'Total Branches',
                                    data: [],
                                    backgroundColor: [],
                                    borderColor: [],
                                    borderWidth: 1
                                }]
                            };

                            // Fetch the number of branches for each individual branch from the database
                            <?php
                            $stmt = $conn->prepare("SELECT b_id, b_name FROM branch");
                            $stmt->execute();
                            $branchData = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // Generate random colors for each branch
                            $colors = array();
                            foreach ($branchData as $branch) {
                                $colors[] = getRandomColor();
                            }

                            function getRandomColor()
                            {
                                $letters = '0123456789ABCDEF';
                                $color = '#';
                                for ($i = 0; $i < 6; $i++) {
                                    $color .= $letters[rand(0, 15)];
                                }
                                return $color;
                            }
                            ?>

                            // Populate the data for the pie chart
                            // totalBranchesData.labels = <?php echo json_encode(array_column($branchData, 'b_name')); ?>;
                            totalBranchesData.datasets[0].data = <?php echo json_encode(array_column($branchData, 'b_id')); ?>;
                            totalBranchesData.datasets[0].backgroundColor = <?php echo json_encode($colors); ?>;
                            totalBranchesData.datasets[0].borderColor = <?php echo json_encode($colors); ?>;

                            var totalBranchesChart = new Chart(totalBranchesCtx, {
                                type: 'pie',
                                data: totalBranchesData,
                                options: {
                                    title: {
                                        display: true,
                                        text: 'Total Branches'
                                    }
                                }
                            });


                            // Total Parcels with Status Pie Chart
                            var totalParcelsCanvas = document.getElementById('total-parcels-chart');
                            var totalParcelsCtx = totalParcelsCanvas.getContext('2d');

                            var totalParcelsData = {
                                // labels: ['Received', 'On the Way', 'Delivered', 'Pending', 'Returned'],
                                // labels: ['Total Parcles'],
                                datasets: [{
                                    label: '',
                                    data: [<?php echo $total_receive_parcels; ?>, <?php echo $total_way_parcels; ?>, <?php echo $total_delivered_parcels; ?>, <?php echo $total_pending_parcels; ?>, <?php echo $total_returned_parcels; ?>],
                                    backgroundColor: [
                                        '#FFC0CB',
                                        '#AFDBF5',
                                        'lightyellow',
                                        '#ACE1AF',
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

                        <div class="col-12 col-sm-6 col-md-3 h-25 mb-3">
                            <a href="userlist.php" style="text-decoration: none;">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h4 class="text-primary"> <span class="text-danger">Total</span> Users</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_users}  <span class='text-success'>Users</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users text-danger" style="font-size: 50px;"></i>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 h-25 mb-3">
                        <a href="agent.php" style="text-decoration: none;">

                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h4 class="text-primary"><span class="text-danger">Total</span> Agents</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_agents}  <span class='text-success'>Agents</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-secret text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                    </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 h-25 mb-3">
                        <a href="viewbranch.php" style="text-decoration: none;">
                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h4 class="text-primary"><span class="text-danger">Total</span> branchs</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_branches}  <span class='text-success'>Branchs</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-code-branch text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                    </a>
                        </div>

                        <div class="col-12 col-sm-6 col-md-3 h-25 mb-3">
                        <a href="parcelslist.php" style="text-decoration: none;">

                            <div class="small-box bg-light shadow-sm border p-3">
                                <div class="inner">
                                    <h4 class="text-primary"> <span class="text-danger">Total</span> Parcels</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_parcels_count}  <span class='text-success'>Parcels</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                    <div class="row">
                        <a href="recieved.php" style="text-decoration: none;" >
                            <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                                <div class="small-box shadow-sm border p-3" style="background-color: #FFC0CB;">
                                    <div class="inner">
                                        <h4 class="text-primary"> <span class="text-danger">Total</span> Received</h4>
                                        <?php echo "<h3 class='text-danger'>{$total_receive_parcels}  <span class='text-success'>Received</span></h3>"; ?>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-boxes text-danger" style="font-size: 50px;"></i>
                                    </div>
                                </div>
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                        <a href="ontheway.php" style="text-decoration: none;">
                            <div class="small-box shadow-sm border p-3" style="background-color: #AFDBF5;">
                                <div class="inner">
                                    <h4 class="text-primary"><span class="text-danger">Total</span> On the Way</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_way_parcels}  <span class='text-success'>On the Way</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                        <a href="pending.php" style="text-decoration: none;">
                            <div class="small-box shadow-sm border p-3 " style="background-color: lightyellow;">
                                <div class="inner">
                                    <h4 class="text-primary"> <span class="text-danger">Total</span> Pending</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_pending_parcels} <span class='text-success'>Pending</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                
                <div class="row justify-content-center">
                    <a href="delivered.php" style="text-decoration: none;">
                        <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                            <div class="small-box shadow-sm border p-3 " style="background-color: #ACE1AF;">
                                <div class="inner">
                                    <h4 class="text-primary"> <span class="text-danger">Total</span> Delivered</h4>
                                    <?php echo "<h3 class='text-danger'>{$total_delivered_parcels}  <span class='text-success'>Delivered</span></h3>"; ?>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-boxes text-danger" style="font-size: 50px;"></i>
                                </div>
                    </a>
                </div>

            </div>

            <div class="col-12 col-sm-6 col-md-4 h-25 mb-3">
                <a href="returned.php" style="text-decoration: none;">
                    <div class="small-box shadow-sm border p-3" style="background-color:rgba(153, 102, 255, 0.2);">
                        <div class="inner">
                            <h4 class="text-primary"><span class="text-danger">Total</span> Returned</h4>
                            <?php echo "<h3 class='text-danger'>{$total_returned_parcels}  <span class='text-success'>Returned</span></h3>"; ?>
                        </div>
                        <div class="icon">
                            <i class="fa fa-boxes text-danger " style="font-size: 50px;"></i>
                        </div>
                    </div>
                </a>
            </div>


        </div>

    </div>







    <!-- Blank End -->


    <?php
    include("footer.php");
    ?>