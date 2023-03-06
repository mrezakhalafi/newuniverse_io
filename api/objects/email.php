<?php

// include php mailer library
include_once '../../PHPMailer/src/PHPMailer.php';
include_once '../../PHPMailer/src/SMTP.php';
include_once '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;

Class Email extends PHPMailer {

    // mailer credentials
    public $Host = 'smtp.gmail.com';
    public $SMTPAuth = true;
    public $Username = 'support@palio.io';
    public $Password = '12345easySoft67890';
    public $SMTPSecure = 'tls';
    public $Port = 587;

    public function __construct()
    {
        $this->isSMTP();
        $this->setFrom('support@palio.io', 'Palio');
        $this->addReplyTo('support@palio.io');
        $this->isHTML(true);
    }

    public function addMultipleAddress($array)
    {
        try {

            foreach ($array as $value) {
                $value_clean = trim($value, " "); // trim space from email
                $this->addAddress($value_clean);
            }

        } catch (Exception $e) {

            return 'Message: Something went wrong!';
            
        }
    }
    
}