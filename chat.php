<?php
$filename = "messages.xml";

// Check if the XML file exists; if not, create it.
if (!file_exists($filename)) {
    $xml = new SimpleXMLElement('<messages></messages>');
    $xml->asXML($filename);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Save a new message to the XML file
    $username = htmlspecialchars($_POST['username']);
    $message = htmlspecialchars($_POST['message']);

    $xml = simplexml_load_file($filename);
    $newMessage = $xml->addChild('message');
    $newMessage->addChild('username', $username);
    $newMessage->addChild('content', $message);
    $newMessage->addChild('timestamp', date('Y-m-d H:i:s'));
    $xml->asXML($filename);
    echo "Message saved.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Serve the XML file
    header('Content-Type: text/xml');
    readfile($filename);
}
?>
