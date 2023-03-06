<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php
    session_start();
    // header('Content-Type: application/json');
    header('Content-type: application/json; charset=utf-8');

    $dbconn = getDBConn();

    if(!$dbconn){
        die("Connection failed: " . $dbconn->error);
    }

    $query =  $dbconn->prepare("SELECT tb.START_TIME, tb.END_TIME, tb.COMPANY,
    SUM( IF( tb.SERVICE_NAME = 'Live Streaming', tb.BYTE, 0) ) AS LiveStreaming,
    SUM( IF( tb.SERVICE_NAME = 'Video Call', tb.BYTE, 0) ) AS VideoCall,
    SUM( IF( tb.SERVICE_NAME = 'Audio Call', tb.BYTE, 0) ) AS AudioCall,
    SUM( IF( tb.SERVICE_NAME = 'Unified Messaging', tb.BYTE, 0) ) AS UnifiedMessaging,
    SUM( IF( tb.SERVICE_NAME = 'Whiteboard', tb.BYTE, 0) ) AS Whiteboard,
    SUM( IF( tb.SERVICE_NAME = 'Screen Sharing', tb.BYTE, 0) ) AS ScreenSharing,
    SUM( IF( tb.SERVICE_NAME = 'Chatbot', tb.BYTE, 0) ) AS Chatbot
    FROM ( SELECT usg.ID, usg.COMPANY, usg.BYTE, usg.START_TIME, usg.END_TIME, srv.SERVICE_NAME FROM `USAGE` usg INNER JOIN COMPONENT cmp ON usg.COMPONENT=cmp.ID INNER JOIN SERVICE srv ON cmp.SERVICE=srv.ID WHERE usg.COMPANY = ? ) tb
    GROUP BY tb.START_TIME;");

    $query->bind_param("i", getSession('id_company'));
    // $company = 146;
    // $query->bind_param("i", $company);
    $query->execute();
    $result = $query->get_result();
    $query->close();

    // DATE
    // $now = new DateTime();
    // $now_date = $now->format('Y-m-d H:i:s');
    // $yesterday_date = date('Y-m-d H:i:s', strtotime($now_date. ' - 1 days'));
    // $week_date = date('Y-m-d H:i:s', strtotime($now_date. ' - 6 days'));
    // $month_date = date('Y-m-d H:i:s', strtotime($cut_off_date. ' - 29 days'));

    $data = array();
    foreach ($result as $row) {
      $data[] = $row;

        // if($_GET['day'] == 'y'){
        //     $data[] = $row;
        //
        // } elseif($_GET['day'] == 'week'){
        //
        //     if($row["START_TIME"] > $week_date){
        //         $data[] = $row;
        //     }
        //
        // } elseif($_GET['day'] == 'month'){
        //
        //     if($row["START_TIME"] > $month_date){
        //         $data[] = $row;
        //     }
        //
        // } elseif($_GET['day'] == 'range'){
        //
        //     $start_date = $_GET['startDate'];
        //     $end_date = $_GET['endDate'];
        //     if($row["START_TIME"] > $start_date && $row["START_TIME"] < $end_date){
        //         $data[] = $row;
        //     }
        //
        // }

    }

    print json_encode($data);

?>
