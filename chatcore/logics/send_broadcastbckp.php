<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $dbconn = paliolite();

    // save file in db
    // move_uploaded_file($_FILES['file']['tmp_name'], '/apps/lcs/paliolite/server/image/' . $_FILES['file']['name']);
     
    
    // get message data
    $message = $_POST['message'];
    $from = $_POST['from'];
    $target = $_POST['target'];
    $start = $_POST['start'];
    $link = $_POST['link'];
    $mode = $_POST['mode'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $survey_id = $_POST['survey_id'];

    if (!isset($_POST['data'])) {
        $data = '';
    } else {
        $data = $_POST['data'];
    }

    if (!isset($_POST['end'])) {
        $end = '';
    } else {
        $end = $_POST['end'];
    }

    // $connection = ssh2_connect('202.158.33.27', 2309);
    // ssh2_auth_password($connection, 'easysoft', '5z2mQ6r+$74LJXa*');

    try {
        if ($category != '0') {
            //code...
            // $audioName = null;
            $imageNameThumb = null;
            $attachment_thumb = null;
            $hex = $_POST['hex'];

            $upload_dir = base_url() . 'chatcore/assets/uploads/';
            $uploaded_file = $upload_dir . $_FILES["file"]["name"];
            $uploaded_file = preg_replace('/\s/i', '%20', $uploaded_file);

            // fetch file type
            $fileType = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));

            // $ssh_local_file = '/var/www/html/palio.io/chatcore/assets/uploads/' . $_FILES["file"]["name"];

            move_uploaded_file($_FILES['file']['tmp_name'], '/apps/lcs/paliolite/server/image/' . $from . '-' . $hex . '.' . $fileType);

            // move file to cu directory
            // copy($uploaded_file, 'http://202.158.33.27:2809/' . $from . '-' . $hex . '.' . $fileType);

            // ssh2_scp_send($connection, $ssh_local_file, '/apps/lcs/paliolite/server/image/' . $from . '-' . $hex . '.' . $fileType, 0777);

            // Valid extensions
            $image_type_arr = array("jpg", "jpeg", "png");
            $video_type_arr = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');
            // $audio_type_arr = array('m4a', 'flac', 'mp3', 'wav', 'wma', 'aac');

            if(in_array($fileType, $image_type_arr)){
                // if image
                $file_id = $from . '-' . $hex . '.' . $fileType;
                $imageNameThumb = $from . '-' . $hex . $fileType;

            } 
            else if (in_array($fileType, $video_type_arr)){
                // if video 

                $is_chrome = $_POST['is_chrome'];

                if($is_chrome == 'true'){

                    $placeholder = base_url() . 'chatcore/assets/img/thumbnail.jpg';
                    $attachment_thumb = file_get_contents($placeholder);

                    // $ssh_local_place = '/var/www/html/palio.io/chatcore/assets/img/thumbnail.jpg';
                    
                    // file_put_contents('/apps/lcs/catchup/server/image/' . $from . '-' . $hex . '.jpg', $attachment_thumb);
                    file_put_contents('/apps/lcs/paliolite/server/image/' . $from . '-' . $hex . '.jpg', $attachment_thumb);
                    // ssh2_scp_send($connection, $ssh_local_place, '/apps/lcs/paliolite/server/image/' . $from . '-' . $hex . '.jpg', 0777);

                } else {

                    // save file in db
                    move_uploaded_file($_FILES['thumbnail']['tmp_name'], '../assets/uploads/' . $_FILES['thumbnail']['name']);

                    $thumbnail_dir = base_url() . 'chatcore/assets/uploads/';
                    $uploaded_thumbnail = $thumbnail_dir . $_FILES["thumbnail"]["name"];
                    $uploaded_thumbnail = preg_replace('/\s/i', '%20', $uploaded_thumbnail);

                    // to return the base64 thumbnail back to normal and save it
                    $attachment_thumb = file_get_contents($uploaded_thumbnail);

                    // $ssh_local_thumb = '/var/www/html/palio.io/chatcore/assets/uploads/' . $_FILES["thumbnail"]["name"];
                    
                    // file_put_contents('/apps/lcs/catchup/server/image/' . $from . '-' . $hex . '.jpg', $attachment_thumb);
                    file_put_contents('/apps/lcs/paliolite/server/image/' . $from . '-' . $hex . '.jpg', $attachment_thumb);
                    // ssh2_scp_send($connection, $ssh_local_thumb, '/apps/lcs/paliolite/server/image/' . $from . '-' . $hex . '.jpg', 0777);
                    

                }

                $file_id = $from . '-' . $hex . '.' . $fileType;
                $imageNameThumb = $from . '-' . $hex . '.jpg';

            } else {
                // if file

                $file_id = $from . '-' . $hex . '.' . $fileType;

            }
        }

    } catch (\Throwable $th) {
        //throw $th;
        echo $th->getMessage();
    }


    // ssh2_exec($connection, 'exit');

    // API broadcast message
    // Code: "BRDCST"
    // Data:
    // "from" : f_pin user yang mengirim broadcast
    // "title" : Judul broadcast
    // "mode" : 1 = once, 2 = daily, 3 = weekly, 4 = monthly
    // "message" : isi message broadcast
    // "start" : Waktu mulai broadcast rutin, millisecond
    // "end" : Waktu selesai broadcast rutin, millisecond
    // "target" : 1 = customer, 2 = team member, 3 = all user, 4 = group, 5 = specific user
    // "data" :
    // - Jika target 4, JSONArray berisi daftar group_id
    // - Jika target 5, JSONArray berisi daftar f_pin user
    // "category" : 0 = chat biasa, 1 = image, 2 = video, 3 = file attached
    // "type" : 1 = push notification, 2 = in-app
    // "link" : isian link
    // "thumb_id" : thumb_id attachment untuk category 1-3
    // "file_id" : file_id attachment untuk category 1-3

    try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'BRDCST',
            'data' => array(
                'from' => $from,
                'title' => $title,
                'mode' => $mode,
                'message' => $message,
                'start' => $start,
                'end' => $end,
                'target' => $target,
                'data' => $data,
                'category' => $category,
                'type' => $type,
                'link' => $link,
                'thumb_id' => $imageNameThumb,
                'file_id' => $file_id,
                'form_id' => $survey_id
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

    echo 'Success';
