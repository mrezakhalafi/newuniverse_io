<?php

require '../gmail/email.php';

//To send email
function send_email($email_address, $full_name, $subject, $body)
{
    try {
        // Get the API client and construct the service object.
        $client = getClient();
        $service = new Google_Service_Gmail($client);

        $message = createMessage('support@qmera.io', $email_address, $subject, $body);
        sendMessage($service, 'me', $message);

        return 'Message has been sent';

    } catch (Exception $e) {

        return "Message could not be sent. Mailer Error: {$e}";
    }
}
