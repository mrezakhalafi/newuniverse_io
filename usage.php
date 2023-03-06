<?php require_once($_SERVER['DOCUMENT_ROOT'].'/headerdashboard.php'); ?>

<?php
    session_start();

    //livestream usage
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 1");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $livestream_usage = $querybyte1['BYTE'];
    $query->close();

    //video call
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 2");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $videocall_usage = $querybyte1['BYTE'];
    $query->close();

    //audio call
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 3");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $voipcall_usage = $querybyte1['BYTE'];
    $query->close();

    //screen sharing
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 4");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $screensharing_usage = $querybyte1['BYTE'];
    $query->close();

    // white boarding
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 5");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $whiteboarding_usage = $querybyte1['BYTE'];
    $query->close();

    //instant messaging
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 6");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $instantmessaging_usage = $querybyte1['BYTE'];
    $query->close();

    //chat bot
    $query =  $dbconn->prepare("SELECT * FROM `USAGE` WHERE COMPANY = ? AND COMPONENT = 7");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querybyte1 = $query->get_result()->fetch_assoc();
    $chatbot_usage = $querybyte1['BYTE'];
    $query->close();

    //PRODUCT ID
    $query= $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ?");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $querysubscribe = $query->get_result()->fetch_assoc();
    $product_id = $querysubscribe['PRODUCT']; //ID PRODUCT
    $query->close();

    //BANDWIDTH AND STORAGE
    $query= $dbconn->prepare("SELECT * FROM PRODUCT WHERE ID = ?");
    $query->bind_param("i", $product_id);
    $query->execute();
    $queryproduct = $query->get_result()->fetch_assoc();
    $bandwidth = $queryproduct['QUOTA_OF_BANDWIDTH'];
    $storage = $queryproduct['QUOTA_OF_STORAGE'];
    $query->close();

    //BYTE SUM
    $query= $dbconn->prepare("SELECT SUM(BYTE) as JUMLAH FROM `USAGE` WHERE COMPANY = ? GROUP BY COMPANY");
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $bytesumquery = $query->get_result()->fetch_assoc();
    $byte = $bytesumquery['JUMLAH'];
    $query->close();

    //remaining storage and bandwidth
    $bandwidth_remaining = ($bandwidth-$byte)/$bandwidth*100;
    $storage_remaining = ($storage-$byte)/$storage*100;

    //PAYMENT REMINDER
    if (($bandwidth-$byte) <= 0) {
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
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@palio.io';
        $mail->Password   = '12345easySoft67890';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

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
      		Palio.io<br>
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

    // REMAINING QUOTA
    // $live_streaming = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 1"); //livestreaming
    // $video_call = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 2"); //videocall
    // $audio_call = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 3"); //audiocall
    // $screen_sharing = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 6"); //screensharing
    // $white_boarding = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 5"); //whiteboarding
    // $instant_messaging = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 4"); //instant messaging
    // $chat_bot = $dbconn->prepare("SELECT QUOTA FROM SERVICE WHERE ID = 7"); //chatbot
    // $query = mysql_query("SELECT * from employee", $connection);

    // $queryUsage = $dbconn->prepare("SELECT * FROM USAGE WHERE COMPANY = ?");
    // $queryUsage->bind_param("i", getSession('company_id'));
    // $queryUsage->execute();
    // $usage_item = $queryUsage->get_result()->fetch_assoc();

    // $remaining = (($usage_item['QUOTA_OF'] - $usage_item['USAGE_'])/$usage_item['BANDWITH'])*100;

    // if($remaining > 0){
    //     $remaining + 0;
    // } else {
    //     $remaining = 0;
    // }

    // if ($itemUser['STATUS'] == 1) {
    //     echo "<script>$('#remaining').addClass('d-none');</script>";
    // } else if ($itemUser['STATUS'] == 2) {
    //     echo "<script>$('#remaining').addClass('d-none');</script>";
    // } else {
    //     echo "<script>$('#remaining').removeClass('d-none');</script>";
    // }

    // if(isset($_POST['startDate'])){
    //     $startdate = strtotime($_POST['startDate']);
    //     $untildate = strtotime($_POST['endDate']);

    //     echo '<script>alert("'.$startdate.'");</script>';

    //     $featureUsage = $dbconn->prepare("SELECT * FROM history_usage WHERE COMPANY = ? AND DATE <= ? AND DATE > ?");
    //     $featureUsage->bind_param("iss", getSession('id_company'), $startdate, $untildate);
    //     $featureUsage->execute();
    //     var_export($featureUsage);
    // }

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-3">
    <div class="container px-3">
        <div class="card isi mb-3">
            <div class="card-body px-2">
                <div class="row mt-1">
                    <p class="d-inline align-self-center my-0 mx-4 px-2 fs-14 fc-70"><b> Usage </b></p>
                    <div class="col-12 col-lg-8 ml-auto d-flex justify-content-sm-end">
                        <div class="row m-0">
                            <div class="col-lg-6 col-12 d-flex justify-content-center my-2 my-lg-0">
                                <a id="sevenday" style="font-size: 14px; width: 120px;" href="usage.php?day=week&company_id=<?php echo getSession('id_company')?>" class="btn btn-default mx-2 <?php if ($_GET['day'] == 'week') {
                                    echo "disabled";
                                } ?>">Last 7 Day</a>
                                <a id="thirtyday" style="font-size: 14px; width: 120px;" href="usage.php?day=month&company_id=<?php echo getSession('id_company')?>" name="rangeMonth" class="btn btn-default mx-2 <?php if ($_GET['day'] == 'month') {
                                    echo "disabled";
                                } ?>">Last 30 Day</a>
                            </div>
                            <div class="col-lg-6 my-2 my-lg-0">
                                <div class="d-flex mx-2" style=" border: 1px solid #C7C7C7; border-radius: 5px;">
                                    <i class="fa fa-calendar align-self-center ml-2" style="color: #C7C7C7;"></i>
                                    <input type="text" class="form-control border-0 text-center align-self-center fs-14" name="daterange">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row mb-3">
                    <div class="col-md-4" id="remaining">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <p class="ml-2 fs-14">Remaining Bandwidth </p>
                                </div>
                                <div class="row justify-content-center pb-2">
                                    <div id="remainingQuota"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <p class="ml-2 fs-14">Remaining Storage</p>
                                </div>
                                <div class="row justify-content-center pb-2">
                                    <div id="remainingStorage"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> Live Streaming</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="livestreaming"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> Video Call</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="videocall"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> Audio Call</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="voipcall"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> Screen Sharing</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="screensharing"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> WhiteBoarding</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="whiteboarding"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> Instant Messaging</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="instantmessaging"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="height: 338px; overflow-y: auto;">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14"><i class="fa fa-exchange"></i> ChatBot</p>
                                </div>
                                <div class="row justify-content-center my-1 py-2">
                                    <p class="fs-30 fc-70" id="chatbot"></p><span class="fs-18 align-self-center m-0"> KB</span>
                                </div>
                                <div class="row justify-content-center my-2 py-2">
                                    <p class="fs-14">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <a class="carousel-control-prev" style="width: 2.5%; background-color: #000; opacity: .2; bottom: 45%; top: 42%;" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" style="color: black !important;" aria-hidden="false"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next bg-dark" style="width: 2.5%; background-color: #000; opacity: .2; bottom: 45%; top: 42%;" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" style="color: black !important;" aria-hidden="false"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="col-md-12 px-0">
            <div class="card">
                <div class="card-body">
                    <div class="row m-0">
                        <div class="col-12">
                            <div class="row m-0">
                                <p class="fs-16 font-weight-bold">Base on Quota (KB)</p>
                            </div>
                            <div class="row m-0">
                                <div class="chart" style="position: relative;">
                                    <canvas id="myChart" style="height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-6">
                            <div class="row m-0">
                                <p class="fs-16 font-weight-bold">Base on Quota (KB)</p>
                            </div>
                            <div class="row m-0">
                                <div class="chart" style="position: relative;">
                                    <canvas id="myChart2" style="height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row m-0">
                                <p class="fs-16 font-weight-bold">Base on Storage (KB)</p>
                            </div>
                            <div class="row m-0">
                                <div class="chart" style="position: relative;">
                                    <canvas id="myChart3" style="height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.content-wrapper -->

<?php if($_GET['day'] == 'week'): ?>
    <script type="text/javascript">
        $('input[name="daterange"]').daterangepicker({
            startDate: moment().day(-6).format('MM/DD/YYYY'),
            endDate: moment().day(0).format('MM/DD/YYYY')
        });
    </script>
<?php endif; ?>

<?php if($_GET['day'] == 'month'):?>
    <script type="text/javascript">
        $('input[name="daterange"]').daterangepicker({
            startDate: moment().day(-29).format('MM/DD/YYYY'),
            endDate: moment().day(0).format('MM/DD/YYYY')
        });
    </script>
<?php endif; ?>

<?php if($_GET['day'] == 'y'):?>
    <script type="text/javascript">
        $('input[name="daterange"]').daterangepicker({
            //startDate: '<?php echo $data[0]; ?>',
            startDate: moment().day(-29).format('MM/DD/YYYY'),
		    endDate: moment().day(0).format('MM/DD/YYYY')
        });
    </script>
<?php endif; ?>

<?php if(isset($_GET['startDate'])):

    $date = date_create($_GET['startDate']);
    $date_start = date_format($date, "m/d/Y");
    $date = date_create($_GET['endDate']);
    $date_end = date_format($date, "m/d/Y");
?>

    <script type="text/javascript">
        $('input[name="daterange"]').daterangepicker({
            startDate: "<?php echo $date_start; ?>",
            endDate: "<?php  echo $date_end; ?>"
        });
    </script>

<?php endif;?>


<script type="text/javascript">

    //daterange
    $('input[name="daterange"]').daterangepicker();
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker){
        window.location = "usage.php?day=range&startDate="+picker.startDate.format('YYYY-MM-DD')+"&endDate="+picker.endDate.format('YYYY-MM-DD')+"&company_id="+<?php echo getSession('id_company')?>;
    });

    var drawQuotaGraph = {
      chart: {
          height: 250,
          type: 'radialBar',
      },
      series: [<?php echo number_format($bandwidth_remaining,1);?>],
      labels: ["<?php echo ($bandwidth-$byte) ?> KB"],
      colors: ['#1a72e8']
    }

    new ApexCharts(document.querySelector("#remainingQuota"), drawQuotaGraph).render();

    var drawStorageGraph = {
      chart: {
          height: 250,
          type: 'radialBar',
      },
      series: [<?php echo number_format($storage_remaining,1);?>],
      labels: ["<?php echo ($storage-$byte) ?> KB"],
      colors: ['#28a745']
    }

    new ApexCharts(document.querySelector("#remainingStorage"), drawStorageGraph).render();

</script>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url : "api_usage.php?day=<?php echo $_GET['day'];?>&company_id=<?php echo $_GET['company_id'];?>&startDate=<?php echo $_GET['startDate'];?>&endDate=<?php echo $_GET['endDate'];?>",
            type : "GET",
            success : function(data){
                // response = jQuery.parseJSON(data);
                // alert(data.length);
                // console.log(data);

                var date = [];
                var chatbot_usage = [];
                var instantmessaging_usage = [];
                var livestreaming_usage = [];
                var videocall_usage = [];
                var voipcall_usage = [];
                var screensharing_usage = [];
                var whiteboarding_usage = [];

                // var livestreaming_usage = [1000,2000,4000];
                // var videocall_usage = [3000,5000,2000];
                // var voipcall_usage = [1000,2000,5000];

                for(var i = 0; i < data.length; i++) {
                    livestreaming_usage.push(data[i].LiveStreaming);
                    videocall_usage.push(data[i].VideoCall);
                    voipcall_usage.push(data[i].AudioCall);
                    date.push(data[i].START_TIME);
                    // chatbot_usage.push(data[i].CHATBOT);
                    instantmessaging_usage.push(data[i].UnifiedMessaging);
                    screensharing_usage.push(data[i].ScreenSharing);
                    whiteboarding_usage.push(data[i].Whiteboard);
                }

                // console.log(date);

                var chartdata = {
                    labels: date,
                    responsive: true,
                    datasets: [
                        {
                            label:"Live Streaming",
                            data:livestreaming_usage,
                            fill:false,
                            borderColor:"rgb(40, 167, 69)",
                            lineTension:0.1
                        },
                        {
                            label:"Video Call",
                            data:videocall_usage,
                            fill:false,
                            borderColor:"rgb(0, 0, 255)",
                            lineTension:0.1
                        },
                        {
                            label:"Audio Call",
                            data:voipcall_usage,
                            fill:false,
                            borderColor:"rgb(255, 255, 51)",
                            lineTension:0.1
                        }
                    ]
                };

                var ctx = $("#myChart");

                var LineGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                },
                            }]
                        }
                    }
                });

                var ctx2 = $("#myChart2");

                var LineGraph = new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: date,
                        datasets: [
                            {
                                label: 'Screen Sharing',
                                data: screensharing_usage,
                                fill: false,
                                borderColor: 'rgba(255, 99, 132, 1)'
                            },
                            {
                                label: 'Whiteboarding',
                                data: whiteboarding_usage,
                                fill: false,
                                borderColor: 'rgba(54, 162, 235, 1)'
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });


                var ctx3 = $("#myChart3");

                var LineGraph = new Chart(ctx3, {
                    type: 'line',
                    data: {
                        labels: date,
                        datasets: [
                        {
                            label: 'Unified Messaging',
                            data: instantmessaging_usage,
                            fill: false,
                            borderColor: 'rgba(75, 192, 192, 1)'
                        },
                        {
                            label: 'Chatbot',
                            data: chatbot_usage,
                            fill: false,
                            borderColor: 'rgba(153, 102, 255, 1)'
                        }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });

            },

            error : function(data) {
                alert(data);
            }

        });
    });

    $(document).ready(function(){
        $.ajax({
            url : "api_usage_sum.php?day=<?php echo $_GET['day'];?>&company_id=<?php echo $_GET['company_id'];?>&startDate=<?php echo $_GET['startDate'];?>&endDate=<?php echo $_GET['endDate'];?>",
            type : "GET",
            success : function(data){
                // alert(data[1]);
            //    var sum = parseInt(data[0].LiveStreaming)+parseInt(data[0].VideoCall)+parseInt(data[0].AudioCall)+parseInt(data[0].UnifiedMessaging)+parseInt(data[0].Whiteboard)+parseInt(data[0].ScreenSharing);

            //    if (sum > 0) {
            //     $('#allusage').text(sum);
            // } else {
            //     $('#allusage').text("0");
            // }

            // if (parseInt(data[0].chatbot) > 0) {
            //     $('#chatbot').text(data[0].chatbot);
            // } else {
            //     $('#chatbot').text("0");
            // }

            var chatbot_usage_sum = 0;
            var unifiedmessaging_usage_sum = 0;
            var livestreaming_usage_sum = 0;
            var videocall_usage_sum = 0;
            var audiocall_usage_sum = 0;
            var screensharing_usage_sum = 0;
            var whiteboard_usage_sum = 0;

            for(var i = 0; i < data.length; i++) {
                livestreaming_usage_sum += parseInt(data[i].LiveStreaming);
                videocall_usage_sum += parseInt(data[i].VideoCall);
                audiocall_usage_sum += parseInt(data[i].AudioCall);
                unifiedmessaging_usage_sum += parseInt(data[i].UnifiedMessaging);
                whiteboard_usage_sum += parseInt(data[i].Whiteboard);
                screensharing_usage_sum += parseInt(data[i].ScreenSharing);
            }

            $('#livestreaming').text(livestreaming_usage_sum);
            $('#videocall').text(videocall_usage_sum);
            $('#voipcall').text(audiocall_usage_sum);
            $('#instantmessaging').text(unifiedmessaging_usage_sum);
            $('#whiteboarding').text(whiteboard_usage_sum);
            $('#screensharing').text(screensharing_usage_sum);

            // if (parseInt(data[0].LiveStreaming) > 0) {
            //     $('#livestreaming').text(data[0].LiveStreaming);
            // } else {
            //     $('#livestreaming').text("0");
            // }

            // if (parseInt(data[0].VideoCall) > 0) {
            //     $('#videocall').text(data[0].VideoCall);
            // } else {
            //     $('#videocall').text("0");
            // }

            // if (parseInt(data[0].AudioCall) > 0) {
            //     $('#voipcall').text(data[0].AudioCall);
            // } else {
            //     $('#voipcall').text("0");
            // }

            // if (parseInt(data[0].UnifiedMessaging) > 0) {
            //     $('#insantmessaging').text(data[0].UnifiedMessaging);
            // } else {
            //     $('#insantmessaging').text("0");
            // }

            // if (parseInt(data[0].Whiteboard) > 0) {
            //     $('#whiteboarding').text(data[0].Whiteboard);
            // } else {
            //     $('#whiteboarding').text("0");
            // }

            // if (parseInt(data[0].ScreenSharing) > 0) {
            //     $('#screensharing').text(data[0].ScreenSharing);
            // } else {
            //     $('#screensharing').text("0");
            // }

            // if (parseInt(data[0]) > 0) {
            //     $('#videocall').text(data[2]);
            // } else {
            //     $('#videocall').text("0");
            // }

            // if (parseInt(data[1]) > 0) {
            //     $('#livestreaming').text(data[1]);
            // } else {
            //     $('#livestreaming').text("0");
            // }

            // if (parseInt(data[3]) > 0) {
            //     $('#voipcall').text(data[3]);
            // } else {
            //     $('#voipcall').text("0");
            // }

            // if (parseInt(data[4]) > 0) {
            //     $('#insantmessaging').text(data[4]);
            // } else {
            //     $('#insantmessaging').text("0");
            // }

            // if (parseInt(data[5]) > 0) {
            //     $('#whiteboarding').text(data[5]);
            // } else {
            //     $('#whiteboarding').text("0");
            // }

            // if (parseInt(data[6]) > 0) {
            //     $('#screensharing').text(data[6]);
            // } else {
            //     $('#screensharing').text("0");
            // }

        },

        error : function(data) {
            alert("ERROR");
        }

    });
    });
</script>

<script type="text/javascript">
    $('.nav-dashboard.use').addClass('active');
</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footerdashboard.php'); ?>
