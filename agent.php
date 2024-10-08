<?php
session_start();
?>
<?php
// Connection
include("connection.php");
?>

<?php
include("header.php");
?>

<!-- Blank Start -->
<div class="container">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">
            <div class="container mt-3">
                <h2 class="text-danger mt-5 ">Agents</h2>
                <div class="table-responsive">
                        <div class="d-flex justify-content-around">
                        <!-- Add a dropdown list of agents -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <select name="agent">
                                <option value="">Select Agent</option>
                                <?php
                                $agents = array();
                                $sql = "SELECT DISTINCT uname FROM users WHERE role = 'agent'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $agent) {
                                    $agents[] = $agent['uname'];
                                ?>
                                    <option value="<?php echo $agent['uname']; ?>"><?php echo $agent['uname']; ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-danger" type="submit">Search</button>
                        </form>

                        <!-- Add a dropdown list of cities -->
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                            <select name="city">
                                <option value="">Select City</option>
                                <?php
                                $cities = array();
                                $sql = "SELECT DISTINCT branch_city FROM users WHERE role = 'agent'";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $city) {
                                    $cities[] = $city['branch_city'];
                                ?>
                                    <option value="<?php echo $city['branch_city']; ?>"><?php echo $city['branch_city']; ?></option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-danger" type="submit">Search</button>
                        </form>
                    </div>
                    <?php
                    if (isset($_GET['agent'])) {
                        $agent = $_GET['agent'];
                        $sql = "SELECT * FROM users WHERE uname = '$agent' AND role = 'agent'";
                    } elseif (isset($_GET['city'])) {
                        $city = $_GET['city'];
                        $sql = "SELECT * FROM users WHERE branch_city = '$city' AND role = 'agent'";
                    } else {
                        $sql = "SELECT * FROM users WHERE role = 'agent'";
                    }

                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>City</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Branch</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $i = 1;
                                foreach ($result as $data) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['branch_city']; ?></td>
                                        <td><?php echo $data['uname']; ?></td>
                                        <td><?php echo $data['upwd']; ?></td>
                                        <td><?php echo $data['role']; ?></td>
                                        <td><?php echo $data['branch_name']; ?></td>
                                        <td>
                                            <button class="btn btn-success border-0">
                                                <a href="editRole.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                    Edit
                                                </a>
                                            </button>
                                        </td>

                                        <td>
                                            <button class="btn btn-danger border-0">
                                                <a onclick="return confirm('Are you sure you want to delete?')" href="deleteRole.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;"> Delete
                                                </a>
                                            </button>
                                        </td>
                                    </tr>

                                <?php $i++;
                                } ?>


                            </tbody>
                        </table>
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