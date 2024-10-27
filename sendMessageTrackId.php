<?php
// connection 
include("connection.php");
?>
<?php
if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/karachi');

    // Check if all required variables are set
    if (isset($_POST['sendername']) && isset($_POST['senderaddress']) && isset($_POST['sendercontact']) && isset($_POST['recipentname']) && isset($_POST['recipentaddress']) && isset($_POST['recipentcontact']) && isset($_POST['weight']) && isset($_POST['price']) && isset($_POST['status'])) {
        // Generate a 10-digit track ID
        $track_id = rand(1000000, 9999999); // 10-digit random number

        // Define the SQL query with placeholders
        $stmt = $conn->prepare("INSERT INTO parcels (track_id, sender_name, sender_address, sender_contact, recipent_name, recipent_address, recipent_contact, weight, price, status, date, agent_name) VALUES (:track_id, :sender_name, :sender_address, :sender_contact, :recipent_name, :recipent_address, :recipent_contact, :weight, :price, :status, :date, :agent_name)");

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
        $added_by = 'admin'; // Hard coded value 'admin'
        $date = date('Y-m-d h:i:s');

        // Bind the variables to the placeholders
        $stmt->bindParam(':track_id', $track_id);
        $stmt->bindParam(':sender_name', $sender_name);
        $stmt->bindParam(':sender_address', $sender_address);
        $stmt->bindParam(':sender_contact', $sender_contact);
        $stmt->bindParam(':recipent_name', $recipent_name);
        $stmt->bindParam(':recipent_address', $recipent_address);
        $stmt->bindParam(':recipent_contact', $recipent_contact);
        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':agent_name', $added_by);

        // Execute the query
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Send SMS using an SMS gateway API
            $message = "Your track ID is $track_id";
            // Replace with your SMS gateway API credentials and function
            echo "<script>alert('Courier Added your Tracking id is " . $track_id . " and SMS sent to your Number');</script>";
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

    $apiURL = "qdwvlr.api.infobip.com";
    $apiKey = "2a423a77769268f02b4d745ab462cd0f-d3e73976-a656-472c-aa12-8b86d2000f33";
    

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
    echo '<script>window.location.href = "parcelslist.php";</script>';


?>