<?php
session_start();
// connection 
include("connection.php");
include("header.php");
?>

<style>
    .animated-arrow {
        animation: blink 1s infinite;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }
</style>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-8 text-center">
            <h2 class="mt-5">Track Parcel</h2>
            <!-- Add a search form above the table -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <div class="input-group">
                    <input type="number" class="form-control" placeholder="Enter Tracking Id" name="search" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-search"></i>
                        </button>

                    </span>
                    <div>
                        <button class="btn btn-primary" onclick="printParcelStatus()">                                            <i class="fa fa-print text-white" style="font-size: 20px;"></i>
                        </button>
                    </div>

                </div>
            </form>
            <?php if (isset($_GET['search'])): ?>
    <?php
    $search = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM parcels WHERE track_id LIKE :track_id");
    $stmt->bindParam(':track_id', $search);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($result)) { // Check if the result array is not empty
        $data = $result[0];
        echo "<h2 style='margin-top: 50px;'>Parcel Status:</h2>";
        echo "Track ID: " . $data['track_id'] . "<br>";
        echo "<br />";

        $statuses = array(1 => 'Received', 2 => 'On the way', 3 => 'Pending', 4 => 'Delivered', 5 => 'Returned');
        $buttons = array();
        if ($data['status'] == 5) { // If status is equal to 5 (Returned)
            $buttons[] = "<button class='btn btn-danger rounded'>Received</button>";
            $buttons[] = "<br><span class='animated-arrow' style='color: red; font-size: 24px; transform: scale(1.5);'>&#8595;</span><br>";
            $buttons[] = "<button class='btn btn-danger rounded'>Pending</button>";
            $buttons[] = "<br><span class='animated-arrow' style='color: red; font-size: 24px; transform: scale(1.5);'>&#8595;</span><br>";
            $buttons[] = "<button class='btn btn-danger rounded'>Returned</button>";
        } else {
            $count = 0;
            foreach ($statuses as $status_id => $status_name) {
                if ($data['status'] >= $status_id) {
                    $buttons[] = "<button class='btn btn-danger rounded'>$status_name</button>";
                    if ($count < $data['status'] - 1) { // Check if it's not the last status
                        $buttons[] = "<br><span class='animated-arrow' style='color: red; font-size: 24px; transform: scale(1.5);'>&#8595;</span><br>";
                    }
                    $count++;
                }
            }
        }
        echo implode('', $buttons);
    } else {
        echo "<br />";
        echo "<span style='color: red; margin-top: 30px;'>No parcel found with track ID " . $search . "</span>";
    }
    ?>
<?php endif; ?>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php
include("footer.php");
?>

<script>
    function printParcelStatus() {
        var status = "<?php echo $data['status']; ?>";
        var trackId = "<?php echo $data['track_id']; ?>";
        var statuses = <?php echo json_encode($statuses); ?>;

        var statusText = "";
        statusText += "<div style='display: flex; justify-content: center; align-items: center; margin-bottom: 20px;'>";
        statusText += "<img src='img/logo.png' style='width: 100px; height: 100px; margin-right: 20px;'/>";
        statusText += "<h1 style='color: red;'>CMS</h1>";
        statusText += "</div>";
        statusText += "<h2 style='text-align: center; color: green;'>Parcel Status:</h2>"; // added green color to the heading
        statusText += "<h3 style='text-align: center; color: red;'>Track ID: " + trackId + "</h3>"; // added orange color to the track ID
        if (status == 5) {
            statusText += "<button style='display: block; margin: 0 auto; color: black; border-radius: 20px;'>Received</button><br>";
            statusText += "<br><span class='animated-arrow' style='color: red; font-size: 24px; display: block; margin: 0 auto;'>&#8595;</span><br>";
            statusText += "<button style='display: block; margin: 0 auto; color: black; border-radius: 20px;'>Pending</button><br>";
            statusText += "<br><span class='animated-arrow' style='color: red; font-size: 24px; display: block; margin: 0 auto;'>&#8595;</span><br>";
            statusText += "<button style='display: block; margin: 0 auto; color: black; border-radius: 20px;'>Returned</button><br>";
        } else {
            for (var i = 1; i <= status; i++) {
                statusText += "<button style='display: block; margin: 0 auto; color: black; border-radius: 20px;'>" + statuses[i] + "</button><br>"; // updated button style
                if (i < status) {
                    statusText += "<br><span class='animated-arrow' style='color: red; font-size: 24px; display: block; margin: 0 auto;'>&#8595;</span><br>";
                }
            }
        }

        statusText += "<h3 style='color: green;'>Thank you for using our courier service.</h3>"; // added h3 thank you message at the end with purple color

        var printWindow = window.open('', '', 'width=400,height=300');
        printWindow.document.write("<style>body { text-align: center; }</style>" + statusText);
        printWindow.print();
    }
</script>