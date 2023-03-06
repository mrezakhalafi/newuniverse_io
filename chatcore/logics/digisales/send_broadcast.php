<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    
    ini_set('upload_max_filesize','64M');


    $dbconn = paliolite();

    // save file in db
    // move_uploaded_file($_FILES['file']['tmp_name'], '../assets/uploads/' . $_FILES['file']['name']);
     
    
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

    if (isset($_POST["user_category"])) {
        $user_category = intval($_POST['user_category']);
    } else {
        $user_category = 0;
    }

    
    $message_id = $from . $start;

    // $connection = ssh2_connect('202.158.33.26', 2309);
    // ssh2_auth_password($connection, 'easysoft', '*347e^!VU4y+#hAP');

    
    $api_data = array(
        'code' => 'BRDCST',
        'data' => array(
            'from' => $from,
            'title' => $title,
            'mode' => $mode,
            'message' => $message,
//            'start' => $start,
//            'end' => $end,
            'start' => $start,
            'end' => $start,
            'target' => $target,
            'data' => $data,
            'outlet_category' => $user_category,
            'category' => $category,
            'type' => $type,
            'root_id' => $message_id,
        ),
    );

    
    // 'link' => $link,
    // 'form_id' => $survey_id

    if ($link != '') {
        $api_data["data"]["link"] = $link;
    }

    if ($survey_id != '') {
        $api_data["data"]["form_id"] = $survey_id;
    }

    $arrCol = ['`MESSAGE_ID`', '`ORIGINATOR`', '`TITLE`', '`CONTENT`', '`START`'];
    $arrValues = ["'$message_id'", "'$from'", "'$title'", "'$message'", $start];

    if (isset($link) && $link != null && $link != '') {
        array_push($arrCol, '`LINK`');
        array_push($arrValues, "'$link'");
    }

    if (isset($_FILES)) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/chatcore/assets/uploads/' . $_FILES['file']['name'])) {
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

                    // copy($uploaded_file, '/apps/lcs/cxbutton/server/image/' . $from . '-' . $hex . '.' . $fileType);

                    // Valid extensions
                    $image_type_arr = array("jpg", "jpeg", "png");
                    $video_type_arr = array("mp4", "mov", "wmv", 'flv', 'webm', 'mkv', 'gif', 'm4v', 'avi', 'mpg');
                    $audio_type_arr = array('m4a', 'flac', 'mp3', 'wav', 'wma', 'aac');

                    if(in_array($fileType, $image_type_arr)){
                        // if image
                        $file_id = $from . '-' . $hex . '.' . $fileType;
                        $imageNameThumb = $from . '-' . $hex .'.' . $fileType;

                        $api_data["data"]["thumb_id"] = $imageNameThumb;
                        $api_data["data"]["file_id"] = $file_id;

                        array_push($arrCol, "`IMAGE_ID`");
                        array_push($arrValues, "'$file_id'");
                        array_push($arrCol, "`THUMB_ID`");
                        array_push($arrValues, "'$imageNameThumb'");
                    } 
                    else if (in_array($fileType, $video_type_arr)){
                        // if video 

                        $is_chrome = $_POST['is_chrome'];

                        if($is_chrome == 'true'){

                            $placeholder = base_url() . 'chatcore/assets/img/thumbnail.jpg';
                            $attachment_thumb = file_get_contents($placeholder);
                            // copy($uploaded_file, '/apps/lcs/cxbutton/server/image/' . $from . '-' . $hex . '.jpg');

                        } else {

                            // save file in db
                            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/chatcore/assets/uploads/' . $_FILES['thumbnail']['name']);

                            $thumbnail_dir = base_url() . 'chatcore/assets/uploads/';
                            $uploaded_thumbnail = $thumbnail_dir . $_FILES["thumbnail"]["name"];
                            $uploaded_thumbnail = preg_replace('/\s/i', '%20', $uploaded_thumbnail);

                            // to return the base64 thumbnail back to normal and save it
                            $attachment_thumb = file_get_contents($uploaded_thumbnail);

                            // copy($uploaded_file, '/apps/lcs/cxbutton/server/image/' . $from . '-' . $hex . '.jpg');
                            

                        }

                        $file_id = $from . '-' . $hex . '.' . $fileType;
                        $imageNameThumb = $from . '-' . $hex . '.jpg';

                        $api_data["data"]["thumb_id"] = $imageNameThumb;
                        $api_data["data"]["file_id"] = $file_id;
                        
                        array_push($arrCol, "`THUMB_ID`");
                        array_push($arrValues, "'$imageNameThumb'");
                        array_push($arrCol, "`VIDEO_ID`");
                        array_push($arrValues, "'$file_id'");

                    } else {
                        // if file

                        $file_id = $from . '-' . $hex . '.' . $fileType;

                        $api_data["data"]["file_id"] = $file_id;

                        if (in_array($fileType, $audio_type_arr)) {
                            array_push($arrCol, "`AUDIO_ID`");
                        } else {
                            array_push($arrCol, "`FILE_ID`");
                        }                    
                        array_push($arrValues, "'$file_id'");

                    }
                }


        // 'thumb_id' => $imageNameThumb,
        // 'file_id' => $file_id,

            

            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
            }
        }
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

        // print_r($_FILES);
        // echo "<br>";
        // print_r($api_data["data"]);
        // echo "<br>";

        $api_url = $webrest_palio;

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

        $listCol = implode(", ", $arrCol);
        $listVal = implode(", ", $arrValues);

        try {

            $sqlHistory = "INSERT INTO `BROADCAST_HISTORY` (".$listCol.") VALUES (".$listVal.")";
            $insertHistory = $dbconn->prepare($sqlHistory);
            $insertHistory->execute();
            $insertHistory->close();
        } catch (Exception $e) {
            echo 'Fail to insert history';
        }
        // echo $sqlHistory;

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    echo 'Success';
