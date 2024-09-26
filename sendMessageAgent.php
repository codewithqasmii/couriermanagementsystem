<?php
session_start()
?>
<?php
include('connection.php');

if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/karachi');

    // Check if all required variables are set
    if (isset($_POST['sendername']) && isset($_POST['senderaddress']) && isset($_POST['sendercontact']) && isset($_POST['recipentname']) && isset($_POST['recipentaddress']) && isset($_POST['recipentcontact']) && isset($_POST['weight']) && isset($_POST['price']) && isset($_POST['status'])) {
        // Generate a 10-digit track ID
        $track_id = rand(1000000, 9999999); // 10-digit random number
        $agent_name = $_SESSION['username'];

        // Define the SQL query with placeholders
        $stmt = $conn->prepare("INSERT INTO parcels (track_id, sender_name, sender_address, sender_contact, recipent_name, recipent_address, recipent_contact, weight, price, status, date, agent_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Define the variables
        $track_id = $track_id;
        $sender_name = $_POST['sendername'];
        $sender_address = $_POST['senderaddress'];
        $sender_contact = $_POST['sendercontact'];
        $recipent_name = $_POST['recipentname'];
        $recipent_address = $_POST['recipentaddress'];
        $recipent_contact = $_POST['recipentcontact'];
        $weight = $_POST['weight'];
        $price = $_POST['price'];
        $status = $_POST['status'];
        $agent_name = $agent_name;
        $date = date('Y-m-d h:i:s');

        // Bind the variables to the placeholders
        $stmt->bind_param("ssssssssssss", $track_id, $sender_name, $sender_address, $sender_contact, $recipent_name, $recipent_address, $recipent_contact, $weight, $price, $status, $date, $agent_name);

        // Execute the query
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Send SMS using an SMS gateway API
            $message = "Your track ID is $track_id";
            // Replace with your SMS gateway API credentials and function
            echo "<script>alert('Courier Added your id is " . $track_id . " and SMS sent to your Number');</script>";
        } 
    }
}
?>


<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

if (isset($_POST["track_id"]) && isset($_POST["sendercontact"])) {
    $message = $track_id;
    $phoneNumber = $_POST["sendercontact"];
    // $apiURL = "pewxg3.api.infobip.com";
    // $apiKey = "b23b9a38e327a4afa16676fff6e07adf-8c428a9c-a50d-4efc-ae7d-90063ff2f8ae";

    $apiURL = "51yvyx.api.infobip.com";
    $apiKey = "dc66f6b9a279eebacdbd28a9c4eb0da8-720ebef1-8404-405e-b5de-e915188cded9";

    try {
        $configuration = new Configuration(host: $apiURL, apiKey: $apiKey);
        $api = new SmsApi(config: $configuration);

        $destination = new SmsDestination(to: $phoneNumber);

        $theMessage = new SmsTextualMessage(
            destinations: [$destination],
            text: "Thankyou for chosing our CMS service. Your Tracking ID is $message to track your parcel go to our website",
            from: "Syntax Flow"
        );

        // send sms message
        $request = new SmsAdvancedTextualRequest(messages: [$theMessage]);
        $response = $api->sendSmsMessage($request);

        // echo "SMS message sent successfully.";
    } catch (Exception $e) {
        // echo "Error sending SMS message: " . $e->getMessage();
    }
} else {
    // echo "Missing required POST variables.";
}


function autoload($className) {
    $fileName = str_replace('\\', '/', $className) . '.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    }
}

spl_autoload_register('autoload');
    echo '<script>window.location.href = "parcelslistAgent.php";</script>';


?>