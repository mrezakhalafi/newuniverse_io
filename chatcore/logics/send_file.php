<?php 

include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

$flag = $_POST['flag'];

if($flag == 1){
    $dbconn = paliolite();
    // $api_url = "http://192.168.0.56:8104/webrest/";
    $api_url = $webrest_palio;
} else {
    $dbconn = catchup();
    $api_url = $webrest_cu;
}

// move_uploaded_file($_FILES['file']['tmp_name'], '../assets/uploads/' . $_FILES['file']['name']);

// get message data
$message_id = $_POST['message_id'];
$originator = $_POST['originator'];
$destination = $_POST['destination'];
$sent_time = $_POST['sent_time'];
$message = $_POST['content'];
$hex = $_POST['hex'];
$scope = $_POST['scope'];
$chat_id = $_POST['chat_id']; // if custom topic

$is_complaint = $_POST['is_complaint'];
$reply_to = $_POST['reply_to'];
$call_center_id = $_POST['call_center_id'];

// if forward, grab existing filename
$audioName = $_POST['audio_id'];
$imageName = $_POST['image_id'];
$videoName = $_POST['video_id'];
$fileName = $_POST['file_id'];
$imageNameThumb = $_POST['thumb_id'];
$attachment_thumb = $_POST['thumb_id'];

// $connection = ssh2_connect('202.158.33.26', 2309);
// ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');

// if an actual file exists, go here, else use existing filename
if (move_uploaded_file($_FILES['file']['tmp_name'], '../assets/uploads/' . $_FILES['file']['name'])) {
    try {
        //code...
        // $audioName = null;
        // $imageName = null;
        // $videoName = null;
        // $imageNameThumb = null;
        // $attachment_thumb = null;
        // $message = null;

        $upload_dir = base_url() . 'chatcore/assets/uploads/';
        $uploaded_file = $upload_dir . $_FILES["file"]["name"];
        $uploaded_file = preg_replace('/\s/i', '%20', $uploaded_file);

        // fetch file type
        $fileType = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));

        // move file to cu directory
        if($flag == 1){
            // copy($uploaded_file, '/apps/lcs/paliolitedev/server/image/' . $originator . '-' . $hex . '.' . $fileType);
            
            $ssh_local_file = '/var/www/html/qmera/chatcore/assets/uploads/' . $_FILES["file"]["name"];

            // move file to cu directory
            // copy($uploaded_file, 'http://202.158.33.27:2809/' . $originator . '-' . $hex . '.' . $fileType);

            // ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $originator . '-' . $hex . '.' . $fileType, 0777);
            copy($uploaded_file, '/apps/lcs/cxbutton/server/image/' . $originator . '-' . $hex . '.' . $fileType);
        } else {
            copy($uploaded_file, '/apps/lcs/catchupdev/server/image/' . $originator . '-' . $hex . '.' . $fileType);
        }

        // Valid extensions
        $image_type_arr = array("jpg", "jpeg", "png");
        $video_type_arr = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');
        $audio_type_arr = array('m4a', 'flac', 'mp3', 'wav', 'wma', 'aac');

        if(in_array($fileType, $image_type_arr)){
            // if image
            $imageName = $originator . '-' . $hex . '.' . $fileType;
            $imageNameThumb = $originator . '-' . $hex . $fileType;

        } else if (in_array($fileType, $audio_type_arr)){
            // if audio
            $audioName = $originator . '-' . $hex . '.' . $fileType;
            $message = $audioName . '|' . $_POST['content'];
            // $message = $audioName . '|';

        } else if (in_array($fileType, $video_type_arr)){
            // if video 

            $is_chrome = $_POST['is_chrome'];

            if($is_chrome == 'true'){

                $placeholder = base_url() . 'chatcore/assets/img/thumbnail.jpg';
                $attachment_thumb = file_get_contents($placeholder);
                
                // file_put_contents('/apps/lcs/catchup/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                if($flag == 1){
                    $ssh_local_place = '/var/www/html/qmera/chatcore/assets/img/thumbnail.jpg';
                    
                    // file_put_contents('/apps/lcs/catchup/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                    // file_put_contents('/apps/lcs/paliolitedev/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                    // ssh2_scp_send($connection, $ssh_local_place, '/apps/lcs/paliolite/server/image/' . $originator . '-' . $hex . '.jpg', 0777);
                    copy($uploaded_file, '/apps/lcs/cxbutton/server/image/' . $originator . '-' . $hex . '.' . $fileType);
                } else {
                    file_put_contents('/apps/lcs/catchupdev/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                }

            } else {

                // save file in db
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../assets/uploads/' . $_FILES['thumbnail']['name']);

                $thumbnail_dir = base_url() . 'chatcore/assets/uploads/';
                $uploaded_thumbnail = $thumbnail_dir . $_FILES["thumbnail"]["name"];
                $uploaded_thumbnail = preg_replace('/\s/i', '%20', $uploaded_thumbnail);

                // to return the base64 thumbnail back to normal and save it
                $attachment_thumb = file_get_contents($uploaded_thumbnail);
                // file_put_contents('/apps/lcs/catchup/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                if($flag == 1){
                    $ssh_local_thumb = '/var/www/html/qmera/chatcore/assets/uploads/' . $_FILES["thumbnail"]["name"];
                    
                    // file_put_contents('/apps/lcs/catchup/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                    // file_put_contents('/apps/lcs/paliolitedev/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                    // ssh2_scp_send$connection, $ssh_local_thumb, '/apps/lcs/paliolite/server/image/' . $originator . '-' . $hex . '.jpg', 0777);
                    copy($uploaded_file, '/apps/lcs/cxbutton/server/image/' . $originator . '-' . $hex . '.' . $fileType);
                } else {
                    file_put_contents('/apps/lcs/catchupdev/server/image/' . $originator . '-' . $hex . '.jpg', $attachment_thumb);
                }

            }

            $videoName = $originator . '-' . $hex . '.' . $fileType;
            $imageNameThumb = $originator . '-' . $hex . '.jpg';

        } else {
            // if file

            $fileName = $originator . '-' . $hex . '.' . $fileType;
            // $message = $fileName . '|';
            $message = $fileName . '|' . $_POST['content'];
        }

    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }
}

// ssh2_exec($connection, 'exit');

// key baru untuk api sendmessage
// - "attachment" : Byte file, di-encode Base64
// - "image_id" : Jika attachmentnya image, nama file di-insert di sini
// - "thumb_id" : Untuk attachment image, isi juga dengan nama file tapi ditambah akhiran "-T" dan ekstensi diganti ".jpg"
// - "video_id" : Jika attachmentnya video, nama file di-insert di sini
// - "audio_id" : Jika attachmentnya file audio, nama file di-insert di sini
// - "file_id" : Jika attachmentnya selain 3 di atas, nama file di-insert di sini

try {

    $api_data = array(
        'code' => 'SNDMSG',
        'data' => array(
            'message_id' => $message_id,
            'from' => $originator,
            'to' => $destination,

            'image_id' => $imageName,
            // thumbnail image
            'thumb_id' => $imageNameThumb,

            'video_id' => $videoName,
            'audio_id' => $audioName,
            'file_id' => $fileName,

            'message_text' => $message,
            'scope' => $scope,
            'chat_id' => $chat_id,

            'is_complaint' => $is_complaint,
            'call_center_id' => $call_center_id,

            'reply_to' => $reply_to
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
    $api_result = file_get_contents($api_url, false, $api_stream);
    $api_json_result = json_decode($api_result);

    if (http_response_code() != 200) {
        throw new Exception('Send message failed!');
    }

} catch (Exception $e) {

    echo $e->getMessage();

}

echo $api_result;
// echo json_encode($api_data);
