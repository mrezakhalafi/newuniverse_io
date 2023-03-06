<?php

// error_log(print_r("CallCenterPalio", TRUE)); 

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $from = $_POST['from'];
    $grpName = $_POST['group_name'];
    $grpId = $_POST['group_id'];
    $grpDesc = $_POST['description'];
    
    $thumb_id = $_POST['thumb_id'];

	try {

        if (move_uploaded_file($_FILES['file']['tmp_name'], '/apps/lcs/paliolite/server/image/' . $thumb_id) == true) {
            $dataArr = array(
                'from' => $from,
                'group_id' => $grpId,
                'group_name' => $grpName,
                'description' => $grpDesc,
                'thumb_id' => $thumb_id
            );
        } else {
            $dataArr = array(
                'from' => $from,
                'group_id' => $grpId,
                'group_name' => $grpName,
                'description' => $grpDesc,
            );
        }

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'CHGGRUP',
            'data' => $dataArr
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
            throw new Exception('create group failed!');
        } else {
            // error_log(print_r("CallCenterPalioSuccess", TRUE)); 
            // $arr_data = array(
            //     'from' => $from,
            //     'grpId' => $grpId,
            //     'group_name' => $grpName,
            //     'description' => $grpDesc
            // );

            echo json_encode($dataArr);
        }

    } catch (Exception $e) {

        echo $e->getMessage();

    }

    // $arr_data = array(
    //     'from' => $from,
    //     'grpId' => $grpId,
    //     'group_name' => $grpName,
    //     'description' => $grpDesc
    // );

    // echo json_encode($arr_data);

    

 ?>