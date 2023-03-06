<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (!isset($_POST) || !isset($_FILES)) {
    echo "No data";
    die();
}

$name = $_POST['name'];
$address = $_POST['address'];
$nik = $_POST['nik'];
$profpic = $_FILES['profpic'];
$trainingImage = $_FILES['training'];
$time = $_POST['time'];

function uploadData($name, $address, $nik, $profpic, $trainingImage, $time)
{

    try {

        $curl = curl_init();

        $postfields = array();

        $postfields['name'] = $name;
        $postfields['address'] = $address;
        $postfields['nik'] = $nik;

        $profpicExt = pathinfo($profpic['name'], PATHINFO_EXTENSION);
        $profpicFilename = 'PP-' . $nik . '_' . $time . '.' . $profpicExt;
        $profpicUpload = move_uploaded_file($profpic['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/image-training/uploads/' . $profpicFilename);
        if ($profpicUpload) {
            $profpicPath = $_SERVER['DOCUMENT_ROOT'] . '/image-training/uploads/' . $profpicFilename;
            $profpicCurlFile = curl_file_create($profpicPath, $profpicExt, $profpicFilename);
            $postfields["profile"] = $profpicCurlFile;
        } else {
            throw new Exception("Profile picture upload failed");
        }

        $trainingArr = array();
        if (isset($trainingImage)) {
            // print_r($trainingImage);
            $trainingImgCount = count($trainingImage['name']);
            // echo "TRAINING: " . $trainingImgCount;
            if ($trainingImgCount > 0) {
                $trainingUploadPath = $_SERVER['DOCUMENT_ROOT'] . '/image-training/training/';
                for ($i = 0; $i < $trainingImgCount; $i++) {
                    $trainingImageExt = pathinfo($trainingImage['name'][$i], PATHINFO_EXTENSION);
                    $trainingImageName = 'TR-' . $nik . '_' . $time . '_'. $i .'.' . $trainingImageExt;
                    $trainingUpload = move_uploaded_file($trainingImage['tmp_name'][$i], $trainingUploadPath . $trainingImageName);
                    if ($trainingUpload) {
                        $trainingCurlFile = curl_file_create($trainingUploadPath . $trainingImageName, $trainingImageExt, $trainingImageName);
                        // array_push($trainingArr, $trainingCurlFile);
                        $keyname = "training" . $i;
                        $postfields[$keyname] = $trainingCurlFile;
                    } else {
                        throw new Exception("Training image upload failed");
                    }
                }

                // $postfields["training"] = $trainingArr;
            }
        }

        // print_r($postfields);

        $headers = array("Content-Type" => "multipart/form-data");

        // print_r($curl_arr);

        curl_setopt_array($curl, array(
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_URL => 'http://103.94.169.26:8349/upload',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postfields,
        ));        

        $result = curl_exec($curl);
        curl_close($curl);

        $json_obj = json_decode($result);
        $status = $json_obj->status;
        $name = $json_obj->message;

        if (intval($status) == 0) {

            echo ("Success");
        } else {

            echo ("Error | " . $json_obj->message);
        }
        
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

uploadData($name, $address, $nik, $profpic, $trainingImage, $time);
