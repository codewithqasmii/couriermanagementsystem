
<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

if (isset($_POST["message"]) && isset($_POST["phoneNumber"])) {
    $message = $_POST["message"];
    $phoneNumber = $_POST["phoneNumber"];
    $apiURL = "pewxg3.api.infobip.com";
    $apiKey = "b23b9a38e327a4afa16676fff6e07adf-8c428a9c-a50d-4efc-ae7d-90063ff2f8ae";

    try {
        $configuration = new Configuration(host: $apiURL, apiKey: $apiKey);
        $api = new SmsApi(config: $configuration);

        $destination = new SmsDestination(to: $phoneNumber);

        $theMessage = new SmsTextualMessage(
            destinations: [$destination],
            text: $message,
            from: "Syntax Flow"
        );

        // send sms message
        $request = new SmsAdvancedTextualRequest(messages: [$theMessage]);
        $response = $api->sendSmsMessage($request);

        echo "SMS message sent successfully.";
    } catch (Exception $e) {
        echo "Error sending SMS message: " . $e->getMessage();
    }
} else {
    echo "Missing required POST variables.";
}


function autoload($className) {
    $fileName = str_replace('\\', '/', $className) . '.php';
    if (file_exists($fileName)) {
        require_once $fileName;
    }
}

spl_autoload_register('autoload');

?>