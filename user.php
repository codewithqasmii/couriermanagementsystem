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
    <div class="row vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">
            <div class="container mt-3">
                <h2>Users List</h2>
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

                            $sql = "select * from users";
                            $result = mysqli_query($conn, $sql);

                            $i = 1;
                            while ($data = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['uname']; ?></td>
                                    <td><?php echo $data['upwd']; ?></td>
                                    <td><?php echo $data['role']; ?></td>
                                    <td>
                                        <button class="btn btn-success border-0">
                                            <a href="editRole.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                Edit
                                            </a>
                                        </button>
                                    </td>

                                    <td>
                                        <button class="btn btn-danger border-0">
                                            <a href="deleteRole.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                Delete
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