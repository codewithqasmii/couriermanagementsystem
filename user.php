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

                            $sql = "SELECT * FROM users WHERE role = 'agent'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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


                <h2 class="text-danger mt-5">Users</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <!-- <th>Branch</th> -->
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $sql = "SELECT * FROM users WHERE role = 'user'";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $i = 1;
                            foreach ($result as $data) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['uname']; ?></td>
                                    <td><?php echo $data['upwd']; ?></td>
                                    <td><?php echo $data['role']; ?></td>
                                    <!-- <td><?php echo $data['branch_name']; ?></td> -->
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
<!-- Blank End -->

<?php
include("footer.php");
?>