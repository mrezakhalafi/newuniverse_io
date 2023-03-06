<?php

// include php ffmpeg library
require '../../vendor/composer/vendor/autoload.php';

class Message
{

    private const API_CODE = "SNDMSG";
    private const API_URL = "http://192.168.1.100:8004/webrest/";
    private const ATTACHMENTS_DIR = "../attachments/";
    private const THUMBNAIL_DIR = "../attachments/thumbnails/";

    // Valid image and video extensions
    private const IMAGE_TYPE = array("jpg", "jpeg", "png");
    private const VIDEO_TYPE = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');
    private const AUDIO_TYPE = array('m4a', 'flac', 'mp3', 'wav', 'wma', 'aac');

    // get message data
    public $MessageID;
    public $Originator;
    public $Destination;
    public $Content;
    public $Hex;
    public $Scope = "3"; // 3 = private, 4 = topic / lounge
    public $ChatID = ""; // if custom topic

    public $IsComplain = "";
    public $ReplyTo =  "";
    public $CCID = "";

    // if forward, grab existing filename
    public $AudioName = "";
    public $ImageName = "";
    public $VideoName = "";
    public $FileName = "";
    public $ImageNameThumb = "";

    private function get_attachment_type($attachment)
    {

        return strtolower(pathinfo($attachment, PATHINFO_EXTENSION));
    }

    public function create_thumbnail($attachment, $attachment_ext)
    {

        try {
            // Video
            if (in_array($this->get_attachment_type($attachment['file']['name']), self::VIDEO_TYPE)) {

                $movie = '../attachments/' . $attachment['file']["name"];
                $thumbnail = $this->Originator . "-" . $this->Hex . ".jpg";

                $ffmpeg = FFMpeg\FFMpeg::create(array(
                    'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
                    'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
                    'timeout' => 3600, // The timeout for the underlying process
                    'ffmpeg.threads' => 12, // The number of threads that FFMpeg should use
                ));
                $video = $ffmpeg->open($movie);
                $video
                    ->filters()
                    ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
                    ->synchronize();
                $video
                    ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1))
                    ->save($thumbnail);

                rename($thumbnail, self::THUMBNAIL_DIR . $thumbnail); // copy to local thumbanil dir
                copy(self::THUMBNAIL_DIR . $thumbnail, '/apps/lcs/paliolitedev/server/image/' . $thumbnail); // copy to paliolite thumbnail dir

                $this->VideoName = $this->Originator . "-" . $this->Hex . "." . $attachment_ext;
                $this->ImageNameThumb = $thumbnail;
            
            // Image
            } else if (in_array($this->get_attachment_type($attachment['file']['name']), self::IMAGE_TYPE)) {

                $this->ImageName = $this->Originator . "-" . $this->Hex . "." . $attachment_ext;
                $this->ImageNameThumb = $this->Originator . "-" . $this->Hex . "." . $attachment_ext;

            // Audio
            } else if (in_array($this->get_attachment_type($attachment['file']['name']), self::AUDIO_TYPE)) {

                $this->AudioName = $this->Originator . '-' . $this->Hex . '.' . $attachment_ext;
                $this->Content = $this->AudioName . '|' . $this->Content;

            // Other docs
            } else {

                $this->FileName = $this->Originator . "-" . $this->Hex . "." . $attachment_ext;
                $this->Content = $this->FileName . "|" . $this->Content;
            }

        } catch (Exception $e) {

            return 'Message: Failed to create thumbnail!';
        }
    }

    public function upload_attachment($attachment)
    {

        try {

            // save file in db
            move_uploaded_file($attachment['file']['tmp_name'], '../attachments/' . $attachment['file']['name']);

            // remove space from attachment name
            $attachment_file = self::ATTACHMENTS_DIR . $attachment["file"]["name"];
            $attachment_file = preg_replace('/\s/i', '%20', $attachment_file);

            // get attachment extension
            $attachment_ext = $this->get_attachment_type($attachment_file);

            // copy file to cu directory
            copy($attachment_file, '/apps/lcs/paliolitedev/server/image/' . $this->Originator . '-' . $this->Hex . '.' . $attachment_ext);

            $this->create_thumbnail($attachment, $attachment_ext);
        } catch (Exception $e) {

            return 'Message: Failed to upload attachment!';
        }
    }

    public function send_message()
    {

        try {

            $api_data = array(
                'code' => self::API_CODE,
                'data' => array(
                    'message_id' => $this->MessageID,
                    'from' => $this->Originator,
                    'to' => $this->Destination,

                    'image_id' => $this->ImageName,
                    'thumb_id' => $this->ImageNameThumb, // thumbnail image

                    'video_id' => $this->VideoName,
                    'audio_id' => $this->AudioName,
                    'file_id' => $this->FileName,

                    'message_text' => $this->Content,
                    'scope' => $this->Scope,
                    'chat_id' => $this->ChatID,

                    'is_complaint' => $this->IsComplain,
                    'call_center_id' => $this->CCID,

                    'reply_to' => $this->ReplyTo
                ),
            );

            $api_options = array(
                'http' => array(
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => strval(json_encode($api_data))
                )
            );

            $api_stream = stream_context_create($api_options);
            $api_result = file_get_contents(self::API_URL, false, $api_stream);
            $api_json_result = json_decode($api_result);

            if (http_response_code() != 200) {
                return false;

            } else {
                return true;

            }

        } catch (Exception $e) {

            return false;
        }

    }

}
