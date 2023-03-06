<?php

    // HIT THIS PAGE TO GET USER STATUS STATUS

    include_once($_SERVER['DOCUMENT_ROOT'] . '/chatcore/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $f_pin = $_GET['company_fpin'];

    // STATUS
    $query = $dbconn->prepare("SELECT fr.FORM_ID, fr.TITLE FROM FORM fr WHERE fr.CREATED_BY = '$f_pin'");
    $query->execute();
    $q_res = $query->get_result();
    $query->close();

    $formList = array();
    while ($form = $q_res->fetch_assoc()) {
        $formList[] = $form;
    };

    // send user data as json
    echo json_encode($formList);
 
?>