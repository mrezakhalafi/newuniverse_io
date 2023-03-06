<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $fpin = $_GET['f_pin'];

    // SELECT GROUP
    $query = $dbconn->prepare("SELECT g.* FROM GROUPS g, MEMBERS m WHERE m.F_PIN = ? AND m.GROUP_ID = g.GROUP_ID");
    $query->bind_param("s", $fpin);
    $query->execute();
    $groups = $query->get_result();
    $query->close();

    $rows = array();
    while ($group = $groups->fetch_assoc()) {
        $rows[] = $group;
    };

    echo json_encode($rows);

?>