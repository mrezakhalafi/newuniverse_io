<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT'] . '/gmail/vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Support Palio');
    $client->setScopes('https://mail.google.com/');
    $client->setAuthConfig($_SERVER['DOCUMENT_ROOT'] . '/gmail/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    $tokenPath = $_SERVER['DOCUMENT_ROOT'] . '/gmail/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // echo 'token exp|';
        // echo 'refreshtoken=' . $client->getRefreshToken();
        // Refresh the token if possible, else fetch a new one.
        $client->fetchAccessTokenWithRefreshToken("1//0ggbaWoOgpmxPCgYIARAAGBASNwF-L9IrL_RqPJodDxJ0-aXzH4q-lGEwSFJsY9kk3zsTZmnxymKhu8wGZYSYENYqTkMs0wVj3iE");
        // 1//0gUHmsX994lVbCgYIARAAGBASNwF-L9IrqYkdUTXG6LR7aT7Lmp1M1IG7Z6FVL8JbcY3wj6wz8LtpinUQp6qTsUGDW7r8xKfojv0
        // $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}

/**
 * @param $sender string sender email address
 * @param $to string recipient email address
 * @param $subject string email subject
 * @param $messageText string email text
 * @return Google_Service_Gmail_Message
 */
function createMessage($sender, $to, $subject, $messageText)
{
    $message = new Google_Service_Gmail_Message();

    $rawMessageString = "From: <{$sender}>\r\n";
    $rawMessageString .= "To: <{$to}>\r\n";
    $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
    $rawMessageString .= "MIME-Version: 1.0\r\n";
    $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
    $rawMessageString .= 'Content-Transfer-Encoding: base64' . "\r\n\r\n";
    $rawMessageString .= "{$messageText}\r\n";

    $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
    $message->setRaw($rawMessage);
    return $message;
}

/**
 * @param $service Google_Service_Gmail an authorized Gmail API service instance.
 * @param $userId string User's email address or "me"
 * @param $message Google_Service_Gmail_Message
 * @return null|Google_Service_Gmail_Message
 */
function sendMessage($service, $userId, $message)
{
    try {
        $message = $service->users_messages->send($userId, $message);
        // print 'Message with ID: ' . $message->getId() . ' sent.';
        return $message;

    } catch (Exception $e) {
        print 'An error occurred: ' . $e->getMessage();
    }

    return null;
}

// // Get the API client and construct the service object.
// $client = getClient();
// $service = new Google_Service_Gmail($client);