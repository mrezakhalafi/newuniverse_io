<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $from = $_POST['from'];
    $parent_id = $_POST['group_id'];
    $subgroupName = $_POST['subgroup_name'];

	try {

        $api_url = $webrest_palio;
        $api_data = array(
            'code' => 'ADDSBGRP',
            'data' => array(
                'from' => $from,
                'parent_id' => $parent_id,
                'group_name' => $subgroupName
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
            throw new Exception('create group failed!');
        } else {
            echo '"' . $grpName . '" created!';
        }

        // echo '"' . $subgroupName . '" created!';

    } catch (Exception $e) {

        echo $e->getMessage();

    }
