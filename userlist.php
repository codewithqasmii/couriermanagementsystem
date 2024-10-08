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

<div class="container">
    <div class="row min-vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">

        <div>
    <h1 class="mb-5 mt-4">Users List</h1>
    <div class="mb-5 d-flex justify-content-between">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="mb-4">
            <!-- form fields here -->
        </form>
        <a href="dashboard.php" class="btn btn-danger">Dashboard</a>
    </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
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