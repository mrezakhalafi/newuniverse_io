<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// include php ffmpeg library
require 'vendor/autoload.php';

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function file_get_contents_ssl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
    curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;

    // Initialize the cURL session

}

$image_mime = "image/";
$video_mime = "video/";
$audio_mime = "audio/";
$others_mime = "application/";

class Message
{

    public $To;
    public $Msg;
    public $Attach_URL;
    public $Image_ID;
    public $Thumb_ID;
    public $Audio_ID;
    public $File_ID;
    public $Video_ID;

    private const WEBREST = "http://192.168.1.100:8004/webrest/";
    private const API_CODE = "SMWU";

    // Valid extensions
    private const IMAGE_TYPE = array("jpg", "jpeg", "png", "webp");
    private const VIDEO_TYPE = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');
    private const AUDIO_TYPE = array('m4a', 'flac', 'mp3', 'wav', 'wma', 'aac');
    private const ATTACHMENTS_DIR = "../attachments/";
    private const THUMBNAIL_DIR = "../attachments/thumbnails/";

    // private $connection = ssh2_connect('202.158.33.26', 2309);

    public $millis;

    private function get_attachment_type($mime_type)
    {
        $file_ext = explode('/', $mime_type);
        // $ext = $file_ext[1];
        $arr_type = array(
            "type" => $file_ext[0],
            "ext" => $file_ext[1]
        );
        return $arr_type;
        // return strtolower(pathinfo($attachment, PATHINFO_EXTENSION));
    }

    public function download_attachment($millis, $attachment, $type)
    {

        $image_mime = "image/";
        $video_mime = "video/";
        $audio_mime = "audio/";
        $others_mime = "application/";

        try {

            // save file in db
            $file_ext = $this->get_attachment_type($type);
            
            // $new_basename = $millis . '-' . pathinfo($attachment, PATHINFO_BASENAME);
            $new_basename = $millis . '-' . $this->To . '-' . $file_ext["type"] . '.' . $file_ext["ext"];
            $file_dir = "../attachments/";
            $status = file_put_contents($file_dir . $new_basename, file_get_contents_ssl($attachment));

            if ($status) {

                // var_dump($status);

                $ssh_local_file = '/apps/web/palio.io/api/attachments/' . $new_basename;
                $connection = ssh2_connect('202.158.33.26', 2309);
                ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');
                if (ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $new_basename, 0777)) {
                    $stream = ssh2_exec($connection, 'exit');
                    if ($stream) {

                        // $attachment_ext = $this->get_attachment_type($new_basename);

                        $this->create_thumbnail($file_dir . $new_basename, $new_basename, $file_ext["ext"]);
                    }
                }
            }
        } catch (Exception $e) {

            return 'Message: Failed to upload attachment!';
        }
    }

    public function create_thumbnail($attachment, $basename, $attachment_ext)
    {

        try {

            if (in_array($attachment_ext, self::VIDEO_TYPE)) {

                // try {

                $movie = $attachment;
                // $thumbnail = pathinfo($movie, PATHINFO_FILENAME) . ".jpg";
                $thumbnail = 'THUMB-' . pathinfo($movie, PATHINFO_FILENAME) . ".jpg";
                // if (copy(self::ATTACHMENTS_DIR . "thumbnail.jpg", self::THUMBNAIL_DIR . "THUMB-" . $thumbnail)) {

                // $ffmpeg = FFMpeg\FFMpeg::create(array(
                //     'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
                //     'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
                //     'timeout' => 3600, // The timeout for the underlying process
                //     'ffmpeg.threads' => 12, // The number of threads that FFMpeg should use
                // ));
                // $video = $ffmpeg->open($movie);
                // $video
                //     ->filters()
                //     ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
                //     ->synchronize();
                // $video
                //     ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1))
                //     ->save(self::THUMBNAIL_DIR . $thumbnail);

                // rename($thumbnail, self::THUMBNAIL_DIR . $thumbnail); // copy to local thumbanil dir

                // $ssh_local_file = '/apps/web/palio.io/api/attachments/thumbnails/' . $thumbnail;

                $ssh_local_file = '/apps/web/palio.io/api/attachments/thumbnail.jpg';
                $connection = ssh2_connect('202.158.33.26', 2309);
                ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');
                if (ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $thumbnail, 0777)) {

                    $stream = ssh2_exec($connection, 'exit');
                    if ($stream) {

                        $this->Video_ID = $basename;
                        $this->Thumb_ID = $thumbnail;
                    }
                }

                // }
                // } catch (Exception $e) {

                //     $thumbnail = pathinfo($movie, PATHINFO_FILENAME) . ".jpg";
                //     copy(self::ATTACHMENTS_DIR . "thumbnail.jpg", self::THUMBNAIL_DIR . "THUMB-" . $thumbnail);
                //     // return 'Message: Failed to create thumbnail!';
                // }

            } elseif (in_array($attachment_ext, self::IMAGE_TYPE)) {

                $imgdata = getimagesize($attachment);

                $imgwidth = $imgdata[0];



                if ($imgwidth > 480) {
                    // get image path string
                    $fname = 'THUMB-' . pathinfo($attachment, PATHINFO_FILENAME) . ".jpg";
                    $thumb_path = self::THUMBNAIL_DIR . $fname;
                    // quality
                    $per = 0.6;

                    // get extension type
                    $type = pathinfo($fname, PATHINFO_EXTENSION);

                    //Generate new size parameters
                    list($width, $height) = getimagesize($attachment);
                    $new_w = $width * $per;
                    $new_h = $height * $per;

                    // Load image
                    $output = imagecreatetruecolor($new_w, $new_h);

                    // handle transparency
                    imagealphablending($output, false);
                    imagesavealpha($output, true);
                    $transparent = imagecolorallocatealpha($output, 255, 255, 255, 127);
                    imagefilledrectangle($output, 0, 0, $new_w, $new_h, $transparent);

                    // create image resource
                    if ($type == 'jpg' || $type == 'jpeg') {
                        $source = imagecreatefromjpeg($attachment);
                    } else if ($type == 'png') {
                        $source = imagecreatefrompng($attachment);
                    } else {
                        $source = imagecreatefromjpeg($attachment);
                    }

                    // Resize the source image to new size
                    imagecopyresampled($output, $source, 0, 0, 0, 0, $new_w, $new_h, $width, $height);

                    // get base64 from image resource
                    if ($type == 'jpg' || $type == 'jpeg') {
                        imagejpeg($output, $thumb_path);
                    } else if ($type == 'png') {
                        imagepng($output, $thumb_path);
                    } else {
                        imagejpeg($output, $thumb_path);
                    }
                } else {
                    $fname = 'THUMB-' . pathinfo($attachment, PATHINFO_BASENAME);
                    copy($attachment, self::THUMBNAIL_DIR . $fname);
                }

                $ssh_local_file = '/apps/web/palio.io/api/attachments/thumbnails/' . $fname;
                $connection = ssh2_connect('202.158.33.26', 2309);
                ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');
                if (ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $fname, 0777)) {
                    $stream = ssh2_exec($connection, 'exit');

                    if ($stream) {

                        $this->Image_ID = $basename;
                        $this->Thumb_ID = $fname;
                    }
                }
            } elseif (in_array($attachment_ext, self::AUDIO_TYPE)) {
                $this->Audio_ID = $basename;
            } else {

                $this->File_ID = $basename;
            }
        } catch (Exception $e) {
            return ('Error sending attachment');
        }
    }

    function sendMsg()
    {

        try {

            $msgdata = array(
                'to' => $this->To,
                'message' => $this->Msg,
                'api' => "",
            );

            if (isset($this->Image_ID)) {
                $msgdata["image_id"] = $this->Image_ID;
                if (isset($this->Thumb_ID)) {
                    $msgdata["thumb_id"] = $this->Thumb_ID;
                }
            } else if (isset($this->Video_ID)) {
                $msgdata["video_id"] = $this->Video_ID;
                if (isset($this->Thumb_ID)) {
                    $msgdata["thumb_id"] = $this->Thumb_ID;
                }
            } else if (isset($this->Audio_ID)) {
                $msgdata["audio_id"] = $this->Audio_ID;
            } else if (isset($this->File_ID)) {
                $msgdata["file_id"] = $this->File_ID;
            }


            $api_url = self::WEBREST;
            $api_data = array(
                'code' => self::API_CODE,
                'data' => $msgdata,
            );

            $api_options = array(
                'http' => array(
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => strval(json_encode($api_data))
                )
            );

            $api_stream = stream_context_create($api_options);
            $api_result = file_get_contents($api_url, false, $api_stream);
            $api_json_result = json_decode($api_result);

            return true;
        } catch (Exception $e) {

            return false;
        }

        // return true;
        // return false;

    }
}

function checkFileExists($url)
{
    // $ext = pathinfo($url, PATHINFO_EXTENSION);

    // if ($ext) {
        // $handle = fopen($url, 'r');
        // $handle = file_get_contents_ssl($url);
        $handle = get_headers($url, true);

        if ($handle) {
            return $handle["Content-Type"];
        } else {
            return false;
        }
    // } else {
    //     return false;
    // }
}

// START HANDLE DATA
$raw = json_decode(file_get_contents('php://input'));

if (isset($raw) && !empty($raw)) {

    $data = $raw->data;

    $To = $data->to;
    $Msg = $data->message;
    $Attach_URL = $data->attach_url;

    $to_valid = ($To !== null) && ($To !== '') && (strlen($To) <= 16);
    $msg_valid = ($Msg !== null) && ($Msg !== '') && (strlen($Msg) <= 1024);

    $millis = floor(microtime(true) * 1000);

    if ($to_valid && $msg_valid) {

        $msgObj = new Message();

        $msgObj->To = $To;
        $msgObj->Msg = $Msg;

        if ($Attach_URL !== null && $Attach_URL !== '') {
            $type = checkFileExists($Attach_URL);
            // var_dump($type);
            if ($type) {

                // $putFile = getFileAndPut($Attach_URL);
                $msgObj->download_attachment($millis, $Attach_URL, $type);
                if ($msgObj->sendMsg()) {

                    // print_r($notification);

                    // 200 OK
                    http_response_code(200);

                    // tell the user
                    echo json_encode(array("message" => "Notification sent."));
                } else {

                    http_response_code(503);

                    // tell the user
                    echo json_encode(array("message" => "Unable to send notification."));
                }
                // } else {
                //     http_response_code(503);

                //     // tell the user
                //     echo json_encode(array("message" => "Unable to send notification."));
                // }


            } else {
                http_response_code(400);

                // tell the user
                echo json_encode(array("message" => "Unable to send notification. URL is invalid or not a file."));
            }
        } else {

            if ($msgObj->sendMsg()) {

                // print_r($notification);

                // 200 OK
                http_response_code(200);

                // tell the user
                echo json_encode(array("message" => "Notification sent."));
            } else {

                http_response_code(503);

                // tell the user
                echo json_encode(array("message" => "Unable to send notification."));
            }
        }
    } else {

        // set response code - 400 bad request
        http_response_code(400);

        // tell the user
        echo json_encode(array("message" => "Unable to send notification. Data is incomplete or invalid."));
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to send notification. Data is incomplete."));
}
