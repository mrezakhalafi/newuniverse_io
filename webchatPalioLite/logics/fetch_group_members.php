<?php 

    include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/webchat/logics/chat_dbconn.php');

    $dbconn = paliolite();
    $fpin = $_POST['group_id'];

    // SELECT GROUP
    $query = $dbconn->prepare("SELECT m.GROUP_ID, g.GROUP_NAME, g.IMAGE_ID, ul.F_PIN, ul.FIRST_NAME, ul.LAST_NAME, m.POSITION, ul.LAST_UPDATE, ul.QUOTE, ul.IMAGE 
    FROM MEMBERS m, USER_LIST ul, `GROUPS` g 
    WHERE m.F_PIN = ul.F_PIN AND m.GROUP_ID = g.GROUP_ID AND m.GROUP_ID = ?");
    $query->bind_param("s", $fpin);
    $query->execute();
    $groups  = $query->get_result();
    $query->close();

    $rows = array();
    while ($group = $groups->fetch_assoc()) {
        $rows[] = $group;
    };

    echo json_encode($rows);

?>