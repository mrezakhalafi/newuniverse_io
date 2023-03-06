<?php

class Vcall
{

    public $ApiKey;
    public $UserID;
    public $RoomName;
    public $Code;
    public $DownloadURL = "http://202.158.33.27/downloads/palio_installer.exe";

    public function generateURL() {

        $url = 'palio:' . $this->ApiKey . '+' . $this->UserID . '+' . $this->Code . '+' . $this->RoomName;
        // $url = 'localhost/api/pages/vcall.php?api_key=' . $this->ApiKey . '&user_id=' . $this->UserID . '&code=' . $this->Code . '&room_name=' . $this->RoomName;
        return $url;
    }
    
}
