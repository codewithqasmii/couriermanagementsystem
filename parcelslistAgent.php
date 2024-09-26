<?php
session_start();
?>
<?php
include('connection.php');
?>

<?php
include("includes/agentheader.php");
?>

<!-- Blank Start -->
<div class="container">
    <div class="row min-vh-100 bg-light rounded justify-content-center mx-0 m-5">
        <div class="col-md-12 text-center">
            <div class="container mt-3">
                <h2>Parcels List</h2>
                <!-- Add a search form above the table -->
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <input type="text" name="search" placeholder="Search by Track ID">
                    <button type="submit">Search</button>
                </form>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Track Id</th>
                                <th>S.Name</th>
                                <th>S.Contact</th>
                                <th>R.Name</th>
                                <th>R.Contact</th>
                                <th>Weight</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Agent</th>
                                <th>Date</th>
                                <th>Action</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            $stmt = $conn->prepare("SELECT * FROM parcels WHERE agent_name = ?");
                            $stmt->bind_param("s", $_SESSION['username']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $i = 1;
                            while ($data = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $data['track_id']; ?></td>
                                    <td><?php echo $data['sender_name']; ?></td>
                                    <td><?php echo $data['sender_contact']; ?></td>
                                    <td><?php echo $data['recipent_name']; ?></td>
                                    <td><?php echo $data['recipent_contact']; ?></td>
                                    <td><?php echo $data['weight']; ?></td>
                                    <td><?php echo $data['price']; ?></td>
                                    <td><?php echo $data['status']; ?></td>
                                    <td><?php echo $_SESSION['username']; ?></td>
                                    <td><?php echo $data['date']; ?></td>
                                    <td>
                                        <button class="btn btn-success border-0">
                                            <a href="editParcelsAgent.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                Edit
                                            </a>
                                        </button>
                                    </td>

                                    <!-- <td>
                                        <button class="btn btn-danger border-0">
                                            <a href="deleteParcel.php?id=<?php echo $data['id']; ?>" style="text-decoration: none; color: black;">
                                                Delete
                                            </a>
                                        </button>
                                    </td> -->
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