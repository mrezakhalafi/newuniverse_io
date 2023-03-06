<?php 

$json_data = json_decode(file_get_contents('php://input'));

class Mail{

    public $from;
    public $to;
    public $message;

    function sendMail(){

        $json_data = array(
            'from' => $this->from,
            'to' => $this->to,
            'message' => $this->message
        );

        return $json_data;
    }
}

if (isset($json_data) && !empty($json_data)) {

    $data = $json_data->data;

    $newMessage = new Mail();

    $newMessage->from = $data->from;
    $newMessage->to = $data->to;
    $newMessage->message = $data->message;

    if ($newMessage->sendMail()){
        echo ('From :'.$newMessage->from.' >>> ');
        echo ('To :'.$newMessage->to.' >>> ');
        echo ("Email terkirim");
    }else{
        echo ("Email gagal dikirim");
    }
}

?>