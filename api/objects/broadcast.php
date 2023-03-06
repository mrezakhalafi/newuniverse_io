<?php

// include php ffmpeg library
// require '../../vendor/composer/vendor/autoload.php';
require '../services/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Class Broadcast {

    /*
    Send : Who send the broadcast.
    Target audience : 1 = Customers, 2 = Team members, 3 = All users, 4 = Specific group(s), 5 = Specific user(s).
    Destination : If the target audience specific group(s) / user(s) choose particular group(s) / user(s) (OPTIONAL).
    Broadcast type : 1 = Push Notification, 2 = In-App Notification.
    Broadcast mode : 1 = Once, 2 = Daily, 3 = Weekly, 4 = Monthly.
    Starting date : Broadcast date and hour (millisecond).
    Ending date : If the broadcast mode is not once, specify the ending date (date and hour (millisecond)) (OPTIONAL)
    Title : Title of the broadcast messsage.
    Message : The body of the broadcast message.
    Category : Type of the content. 0 = Regular chat, 1 = Image, 2 = Video, 3 = File/Document.
    Attachments : Attach files to be sent (OPTIONAL).
    AttachmentsID : File name (OPTIONAL).
    Attachments : Thumbnail name (OPTIONAL).
    link : Attach link to be sent (OPTIONAL).
    */
    public $Sender;
    public $TargetAudience;
    public $Destinations;
    public $BroadcastType;
    public $BroadcastMode;
    public $StartingDate;
    public $EndingDate = '';
    public $Title;
    public $Message;
    public $Category;
    public $Attachment = '';
    public $AttachmentThumbnail = '';
    public $AttachmentID = '';
    public $Link = '';
    public $Hex;
    public $FormID = '';

    

    // broadcast api
    private const WEBREST_PALIO = "http://192.168.1.100:8004/webrest/";
    private const API_CODE = "BRDCST";

    // Valid extensions
    private const IMAGE_TYPE = array("jpg", "jpeg", "png");
    private const VIDEO_TYPE = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');
    private const ATTACHMENTS_DIR = "../attachments/";
    private const THUMBNAIL_DIR = "../attachments/thumbnails/";


    private function get_attachment_type($attachment) {

        return strtolower(pathinfo($attachment, PATHINFO_EXTENSION));

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
            // copy($attachment_file, '/apps/lcs/paliolitedev/server/image/' . $this->Sender . '-' . $this->Hex . '.' . $attachment_ext);

            $connection = ssh2_connect('202.158.33.26', 2309);
            ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');
            if (ssh2_scp_send($connection, $attachment_file, '/apps/lcs/paliolite/server/image/' . $this->Sender . '-' . $this->Hex . '.' . $attachment_ext, 0777)) {
                $stream = ssh2_exec($connection, 'exit');
                if ($stream) {

                    // $attachment_ext = $this->get_attachment_type($new_basename);

                    // $this->create_thumbnail($file_dir . $new_basename, $new_basename, $file_ext["ext"]);
                    $this->create_thumbnail($attachment, $attachment_ext);
                }
            }

            // $this->create_thumbnail($attachment, $attachment_ext);
        } catch (Exception $e) {

            return 'Message: Failed to upload attachment!';
        }
    }

    public function create_thumbnail($attachment, $attachment_ext)
    {

        try {
            if (in_array($this->get_attachment_type($attachment['file']['name']), self::VIDEO_TYPE)) {

                // $movie = '../attachments/' . $attachment['file']["name"];
                $thumbnail = 'THUMB-' . $this->Sender . "-" . $this->Hex . ".jpg";

                // $ffmpeg = FFMpeg\FFMpeg::create(array(
                //     'ffmpeg.binaries' => 'C:/ffmpeg/bin/ffmpeg.exe',
                //     'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe',
                //     'timeout' => 3600, // The timeout for the underlying process
                //     'ffmpeg.threads' => 12, // The number of threads that FFMpeg should use
                // ));
                // $video = $ffmpeg->open($movie);
                // $video
                // ->filters()
                //     ->resize(new FFMpeg\Coordinate\Dimension(320, 240))
                //     ->synchronize();
                // $video
                // ->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1))
                // ->save($thumbnail);

                // rename($thumbnail, self::THUMBNAIL_DIR . $thumbnail); // copy to local thumbanil dir
                // copy(self::THUMBNAIL_DI R . $thumbnail, '/apps/lcs/paliolitedev/server/image/' . $thumbnail); // copy to paliolite thumbnail dir

                // $this->AttachmentID = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                // // $this->AttachmentThumbnail = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                // $this->AttachmentThumbnail = $thumbnail;

                $ssh_local_file = '../attachments/thumbnail.jpg';
                $connection = ssh2_connect('202.158.33.26', 2309);
                ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');
                if (ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $thumbnail, 0777)) {

                    $stream = ssh2_exec($connection, 'exit');
                    if ($stream) {

                        $this->AttachmentID = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                        $this->AttachmentThumbnail = $thumbnail;
                    }
                }
            } elseif (in_array($this->get_attachment_type($attachment['file']['name']), self::IMAGE_TYPE)) {

                // $this->AttachmentID = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                // $this->AttachmentThumbnail = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                $attachment_name = '../attachments/' . $attachment['file']['name'];
                $imgdata = getimagesize($attachment_name);

                $imgwidth = $imgdata[0];


                if ($imgwidth > 480) {
                    // get image path string
                    $fname = 'THUMB-' . $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                    $thumb_path = self::THUMBNAIL_DIR . $fname;
                    // quality
                    $per = 0.6;

                    // get extension type
                    $type = pathinfo($fname, PATHINFO_EXTENSION);

                    //Generate new size parameters
                    list($width, $height) = getimagesize($attachment_name);
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
                    $fname = 'THUMB-' . $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                    copy('../attachments/' . $attachment['file']['name'], self::THUMBNAIL_DIR . $fname);
                }

                $ssh_local_file = '../attachments/thumbnails/' . $fname;
                $connection = ssh2_connect('202.158.33.26', 2309);
                ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');
                if (ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $fname, 0777)) {
                    $stream = ssh2_exec($connection, 'exit');

                    if ($stream) {

                        // $this->AttachmentID = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                        // $this->AttachmentThumbnail = 'THUMB-' . $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                        $this->AttachmentID = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
                        $this->AttachmentThumbnail = $fname;
                    }
                }
            } else {

                $this->AttachmentID = $this->Sender . "-" . $this->Hex . "." . $attachment_ext;
            }
        } catch (Exception $e) {

            return 'Message: Failed to create thumbnail!';
        }
    }

    /* 
    API broadcast message
    Code: "BRDCST"
    Data:
        "from" : f_pin user yang mengirim broadcast
        "title" : Judul broadcast
        "mode" : 1 = once, 2 = daily, 3 = weekly, 4 = monthly
        "message" : isi message broadcast
        "start" : Waktu mulai broadcast rutin, millisecond
        "end" : Waktu selesai broadcast rutin, millisecond
        "target" : 1 = customer, 2 = team member, 3 = all user, 4 = group, 5 = specific user
        "data" :
            - Jika target 4, JSONArray berisi daftar group_id
            - Jika target 5, JSONArray berisi daftar f_pin user
        "category" : 0 = chat biasa, 1 = image, 2 = video, 3 = file attached
        "type" : 1 = push notification, 2 = in-app
        "link" : isian link
        "thumb_id" : thumb_id attachment untuk category 1-3
        "file_id" : file_id attachment untuk category 1-3
    */
    public function send_broadcast()
    {

        try {

            $api_url = self::WEBREST_PALIO;
            $api_data = array(
                'code' => self::API_CODE,
                'data' => array(
                    'from' => $this->Sender,
                    'title' => $this->Title,
                    'mode' => $this->BroadcastMode,
                    'message' => $this->Message,
                    'start' => $this->StartingDate,
                    'end' => $this->EndingDate,
                    'target' => $this->TargetAudience,
                    'data' => $this->Destinations,
                    'category' => $this->Category,
                    'type' => $this->BroadcastType,
                    'link' => $this->Link,
                    'thumb_id' => $this->AttachmentThumbnail,
                    'file_id' => $this->AttachmentID,
                    'form_id' => $this->FormID
                ),
            );

            $api_options = array(
                'http' => array(
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => strval(json_encode($api_data))
                )
            );

            // echo "form2 " . $this->FormID;
            // echo "<br>";
            // print_r($api_data);
            // echo "<br>";

            $api_stream = stream_context_create($api_options);
            $api_result = file_get_contents($api_url, false, $api_stream);
            $api_json_result = json_decode($api_result);

            return true;
        } catch (Exception $e) {

            return false;
        }
    }

}