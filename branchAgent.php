<?php
session_start();
// Database connection
include("connection.php");
include("header.php");

// SQL query
$sql = "SELECT branch_city, branch_name, COUNT(uname) as total_agents
FROM users
WHERE role = 'agent' AND branch_name IS NOT NULL AND branch_name != ''
GROUP BY branch_city, branch_name";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $branch_agents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display branch wise agents in a table
?>


        <!-- Blank Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row bg-light rounded justify-content-center mx-0">
                <div class="col-md-12 text-center">
                    <h1 class="text-danger mt-5 mb-5">City Wise Branches</h1>

                   <?php
$current_city = '';

        foreach ($branch_agents as $row) {
            $branch_city = $row['branch_city'];
            $branch_name = $row['branch_name'];
            $total_agents = $row['total_agents'];

            if ($branch_city != $current_city) {
                echo "<tr><td colspan='3'><h2 style='color:red;margin-top:20px;'>$branch_city</h2></td></tr>";
                $current_city = $branch_city;
            }

            echo "<tr>";
            ?>
<table class="table table-striped">
    <thead>
        <tr>
            <!-- <th>City</th> -->
            <th>Branch Name</th>
            <th>Total Agents</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // echo "<td>$branch_city</td>";
            echo "<td>$branch_name</td>";
            echo "<td>$total_agents</td>";
            echo "<td><a href='branchAgentParcels.php?branch_name=$branch_name' class='btn btn-danger'>Show Details</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>


                </div>
            </div>
        </div>
        <!-- Blank End -->

<?php
    } else {
        echo "No results found";
    }
} catch (PDOException $e) {
    echo "Error executing query: " . $e->getMessage();
    exit;
}
?>

<?php
include("footer.php");
?>