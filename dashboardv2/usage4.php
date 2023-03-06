<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>

<?php
session_start();
unset($_SESSION['bill']);

$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc limit 1");
$query->bind_param("i", getSession('id_company'));
$query->execute();
$bill2 = $query->get_result()->fetch_assoc();
$due_date = $bill2["DUE_DATE"];
$query->close();


////////////////////////////////// billing related code //////////////////////

//PRODUCT ID
$query = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ?");
$query->bind_param("i", getSession('id_company'));
$query->execute();
$querysubscribe = $query->get_result()->fetch_assoc();
$product_id = $querysubscribe['PRODUCT']; //ID PRODUCT
$query->close();

//BANDWIDTH AND STORAGEaa
$query = $dbconn->prepare("SELECT * FROM PRODUCT WHERE ID = ?");
$query->bind_param("i", $product_id);
$query->execute();
$queryproduct = $query->get_result()->fetch_assoc();
$bandwidth = $queryproduct['QUOTA_OF_BANDWIDTH'];
$storage = $queryproduct['QUOTA_OF_STORAGE'];
$query->close();

//BYTE SUM
$query = $dbconn->prepare("SELECT SUM(BYTE) as JUMLAH FROM `USAGE` WHERE COMPANY = ? GROUP BY COMPANY");
$query->bind_param("i", getSession('id_company'));
$query->execute();
$bytesumquery = $query->get_result()->fetch_assoc();
$byte = $bytesumquery['JUMLAH'];
$query->close();

//PAYMENT REMINDER
if (($bandwidth - $byte) <= 0) { // $pay_reminder=1; $msg="Payment Reminder" ; $company_id=getSession('id_company'); //GET SUBSCRIBE ID $query=$dbconn->prepare("SELECT ID FROM SUBSCRIBE WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
    // $pay_reminder = 1;
    $msg = "Payment Reminder";
    $company_id = getSession('id_company');

    //GET SUBSCRIBE ID
    $query = $dbconn->prepare("SELECT ID FROM SUBSCRIBE WHERE COMPANY = ? ORDER BY ID ASC LIMIT 1");
    $query->bind_param("i", $company_id);
    $query->execute();
    $subscribe = $query->get_result()->fetch_assoc();
    $subscribe_id = $subscribe['ID'];
    $query->close();

    //BILLING INSERT QUERY
    $charge = 35.00;
    $query = $dbconn->prepare("INSERT INTO BILLING (BILL_DATE, DUE_DATE, COMPANY, SUBSCRIBE, CHARGE, CUT_OFF_DATE, IS_PAID) VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 30 DAY), ?, ?, ?, DATE_ADD(NOW(), INTERVAL 37 DAY), 0)");
    $query->bind_param("iid", $company_id, $subscribe_id, $charge);
    $query->execute();
    $query->close();

    // START EMAIL
    $email = $_SESSION['email'];
    require $_SERVER['DOCUMENT_ROOT'] . 'PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . 'PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@palio.io';
    $mail->Password = '12345easySoft67890';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom('support@palio.io', 'Palio');
    $mail->addAddress($email);
    $mail->addReplyTo('support@palio.io');

    $mail->isHTML(true);
    $mail->Subject = 'Reminder: Payment';
    $mail->Body = "Dear user...<br>
    We detected that you have reach the limit of your package, if you want to continue using our services please make a repayment.
    <br>
    Thank you.<br>
    With Regards<br>
    PalioSDK<br>
    ";

    if (!$mail->send()) {
        $succMsg = "";
        $mail->ClearAllRecipients();
        $msg = 'Error : ' . $mail->ErrorInfo;
    } else {
        $mail->ClearAllRecipients();
        $sent = true;
        $msg = 'Sent';
    }
    // END EMAIL

}

/////////////////////////// end /////////////////////////////////////////

$query = $dbconn->prepare("SELECT tb.START_TIME, tb.END_TIME, tb.COMPANY,
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
$result = $query->get_result(); //seluruh pemakaian dari sebuah company berbentuk array dalam array
$query->close();

$ls_sum_all = 0;
$vc_sum_all = 0;
$ac_sum_all = 0;
$um_sum_all = 0;
$wb_sum_all = 0;
$ss_sum_all = 0;
$cb_sum_all = 0;
$ls_sum = 0;
$vc_sum = 0;
$ac_sum = 0;
$um_sum = 0;
$wb_sum = 0;
$ss_sum = 0;
$cb_sum = 0;

//sum of all usage by a company
$rows = array();
foreach ($result as $row) {

    array_push($rows, $row); //every row from different start time usage
    $ls_sum_all += $row['LiveStreaming'];
    $vc_sum_all += $row['VideoCall'];
    $ac_sum_all += $row['AudioCall'];
    $um_sum_all += $row['UnifiedMessaging'];
    $wb_sum_all += $row['Whiteboard'];
    $ss_sum_all += $row['ScreenSharing'];
    $cb_sum_all += $row['Chatbot'];

    // this month
    if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
        $ls_sum += $row['LiveStreaming'];
        $vc_sum += $row['VideoCall'];
        $ac_sum += $row['AudioCall'];
        $um_sum += $row['UnifiedMessaging'];
        $wb_sum += $row['Whiteboard'];
        $ss_sum += $row['ScreenSharing'];
        $cb_sum += $row['Chatbot'];
    }
}
$rows_length = count($rows); //length of the rows array

//GET SUM OF PREVIOUS MONTH
$query5 = $dbconn->prepare("SELECT
SUM(BYTE) as BYTE_SUM
FROM
new_nus.usage
WHERE
DATE(end_time) BETWEEN
  DATE_ADD(
    LAST_DAY(
      DATE_SUB(
        CURDATE(), INTERVAL 2 MONTH
      )
    ),
    INTERVAL 1 DAY
  )
  AND
  LAST_DAY(
    DATE_SUB(
      CURDATE(), INTERVAL 1 MONTH
    )
  )
  AND COMPANY = ?");

$query5->bind_param("i", getSession('id_company'));
$query5->execute();
$result5 = $query5->get_result()->fetch_assoc();
$query5->close();
$last_month_sum = $result5['BYTE_SUM'];
if ($last_month_sum == NULL) {
    $last_month_sum = 0;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    var bandwidth = <?php echo $bandwidth; ?>;
    var storage = <?php echo $storage; ?>;

    var date = [];
    var chatbot_usage = [];
    var unifiedmessaging_usage = [];
    var livestreaming_usage = [];
    var videocall_usage = [];
    var audiocall_usage = [];
    var screensharing_usage = [];
    var whiteboard_usage = [];
    var monthly_bandwidth = [];
    var monthly_storage = [];

    $.ajax({
        url: "api_usage.php",
        type: "GET",
        dataType: 'JSON',
        success: function(data) {
            // response = jQuery.parseJSON(data);
            // alert(data.length);
            // console.log(data);

            for (var i = 0; i < data.length; i++) {
                livestreaming_usage.push(data[i].LiveStreaming);
                videocall_usage.push(data[i].VideoCall);
                audiocall_usage.push(data[i].AudioCall);
                unifiedmessaging_usage.push(data[i].UnifiedMessaging);
                screensharing_usage.push(data[i].ScreenSharing);
                whiteboard_usage.push(data[i].Whiteboard);
                chatbot_usage.push(data[i].Chatbot);
                monthly_bandwidth.push(bandwidth - (data[i].LiveStreaming) - (data[i].VideoCall) - (data[i].AudioCall) - (data[i].UnifiedMessaging) - (data[i].Whiteboard) - (data[i].ScreenSharing) - (data[i].Chatbot));
                monthly_storage.push(storage - (data[i].LiveStreaming) - (data[i].VideoCall) - (data[i].AudioCall) - (data[i].UnifiedMessaging) - (data[i].Whiteboard) - (data[i].ScreenSharing) - (data[i].Chatbot));
            }
        }
    });
</script>

<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="card-name"><strong>Bandwidth Usage</strong></h4><br>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card" id="bandwidth-chart">
                        <canvas id="bandwidth-usage"></canvas>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card" id="monthly-report">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h4 class="card-name">Monthly Report</h4>
                                <span style="font-weight:lighter; font-family:'Work Sans', sans-serif;">Period <?php echo date("F Y"); ?></span>
                            </div>
                        </div>
                        <div class="row my-5" id="total-bandwidth">
                            <div class="col-lg-9 col-md-9">
                                <h4>Total bandwidth usage</h4>
                            </div>
                            <div class="col-lg-3 col-md-3" id="total-usage">
                                <h4><strong>
                                        <?php
                                        $month_total = $ls_sum + $vc_sum + $ac_sum + $um_sum + $wb_sum + $ss_sum + $cb_sum;
                                        echo $month_total;
                                        ?> GB
                                    </strong></h4>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h5>Most used feature</h5>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $most_used = max($ls_sum, $vc_sum, $ac_sum, $um_sum, $wb_sum, $ss_sum, $cb_sum);
                            ?>
                            <div class="col-xl-8 col-md-6 col-sm-12">
                                <h4><strong>
                                        <?php
                                        if ($most_used == $ls_sum) {
                                            echo "Live Streaming";
                                        } else if ($most_used == $vc_sum) {
                                            echo "Video Call";
                                        } else if ($most_used == $ac_sum) {
                                            echo "Audio Call";
                                        } else if ($most_used == $um_sum) {
                                            echo "Unified Messaging";
                                        } else if ($most_used == $wb_sum) {
                                            echo "Whiteboarding";
                                        } else if ($most_used == $_sum) {
                                            echo "Screen Sharing";
                                        } else if ($most_used == $_sum) {
                                            echo "Chatbot";
                                        }
                                        ?>
                                    </strong></h4>
                            </div>
                            <div class="col-xl-4 col-md-6 col-sm-12">
                                <h4 id="most-used"><strong>
                                        <?php
                                        echo $most_used;
                                        ?> GB
                                    </strong></h4>
                            </div>

                            <?php

                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card" id="growth">
                        <h4 style="font-family:'Work Sans',sans-serif;"><strong>Growth</strong></h4>
                        <span style="font-size:0.9rem; font-weight:lighter; font-family:'Work Sans', sans-serif;">This month's usage compared to last month</span>
                        <div class="row my-4">
                            <!-- <div class="col-xl-12"> -->
                            <div class="col-xl-5 col-lg-5 col-md-12 text-center mx-auto compare">
                                <h5 style="font-family:'Josefin Sans', sans-serif;"><strong><?php echo date("F"); ?></strong></h5>
                                <div class="btn btn-yellow" id="current-month">
                                    <span class="growth-usage"></span>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-12 text-center mx-auto compare" id="prev-month">
                                <h5 style="font-family:'Josefin Sans', sans-serif;"><strong><?php echo date("F", strtotime("-1 month")); ?></strong></h5>
                                <div class="btn btn-yellow-1" id="last-month">
                                    <span class="growth-usage"></span>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <span class="growth-percent">

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h4 class="card-name"><strong>Monthly Recap Report</strong></h4><br>
                    <div class="card" id="monthly-chart">
                        <canvas id="monthly-recap"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script>
    $(document).ready(function() {
        $('a.nav-link[href="billpayment.php"]').removeClass('active');
        $('a.nav-link[href="index.php"]').removeClass('active');
        $('a.nav-link[href="usage.php"]').addClass('active');
        $('a.nav-link[href="mailbox.php"]').removeClass('active');
        $('a.nav-link[href="support.php"]').removeClass('active');
    });

    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    // randomScalingFactor(),
                    // randomScalingFactor(),
                    // randomScalingFactor(),
                    // randomScalingFactor(),
                    // randomScalingFactor(),
                    // randomScalingFactor(),
                    // randomScalingFactor()
                    <?php echo $ls_sum; ?>,
                    <?php echo $vc_sum; ?>,
                    <?php echo $ac_sum; ?>,
                    <?php echo $um_sum; ?>,
                    <?php echo $wb_sum; ?>,
                    <?php echo $ss_sum; ?>,
                    <?php echo $cb_sum; ?>,
                ],
                backgroundColor: [
                    'rgb(255, 0 , 0)',
                    'rgb(255, 127, 0)',
                    'rgb(255, 255, 0)',
                    'rgb(0, 255, 0)',
                    'rgb(0, 0, 255)',
                    'rgb(75, 0, 130)',
                    'rgb(148, 0, 211)'
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'Livestreaming',
                'Video Call',
                'Audio Call',
                'Unified Messaging',
                'Whiteboarding',
                'Screen Sharing',
                'Chatbot'
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
            },
            title: {
                display: false,
                text: 'Chart.js Doughnut Chart'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    // var monthly = [612, 296, 669, 995, 342, 314, 541, 163, 327, 394];
    var config_monthly = {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September'],
            datasets: [{
                backgroundColor: 'rgb(255, 0, 0)',
                borderColor: 'rgb(255, 0, 0)',
                data: monthly_bandwidth,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            title: {
                display: false,
                text: 'Chart.js Line Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            legend: {
                display: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                }],
                yAxes: [{
                    display: false,
                    scaleLabel: {
                        display: false,
                        labelString: 'Value'
                    }
                }]
            }
        }
    };

    window.onload = function() {
        var ctx = document.getElementById('bandwidth-usage');
        window.myDoughnut = new Chart(ctx, config);
        var ctx2 = document.getElementById('monthly-recap');
        window.myLineChart = new Chart(ctx2, config_monthly);
    };

    console.log('session: ' + <?php echo $_SESSION['id_company']; ?>);

    // var last_month = 421;
    var last_month = <?php echo $last_month_sum; ?>;
    // var cur_month = 604;
    var cur_month = <?php echo $month_total ?>;

    $('#current-month span.growth-usage').text(cur_month + 'GB');
    $('#last-month span.growth-usage').text(last_month + 'GB');

    var percentage = Math.abs(Math.round((cur_month - last_month) / Math.abs(last_month) * 100));

    if (cur_month - last_month < 0) {
        $('span.growth-percent').text('-' + percentage + '%');
        $('span.growth-percent').css('color', '#ff0000');
    } else if (cur_month - last_month == 0) {
        $('span.growth-percent').text('~0%');
        $('span.growth-percent').css('color', '#000000');
    } else if (cur_month - last_month > 0) {
        $('span.growth-percent').text('+' + percentage + '%');
        $('span.growth-percent').css('color', '#679b67');
    }
</script>

</body>

</html>
