<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php

if ($_SESSION['id_company'] == '') {
    header("Location:" . base_url() . "login.php");
}

session_start();
unset($_SESSION['bill']);

$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc limit 1");
$query->bind_param("i", getSession('id_company'));
$query->execute();
$bill2 = $query->get_result()->fetch_assoc();
$due_date = $bill2["DUE_DATE"];
$query->close();

//company info product interest
$query = $dbconn->prepare("SELECT * FROM COMPANY_INFO WHERE COMPANY = ? order by CREATED_DATE desc limit 1");
$query->bind_param("i", getSession('id_company'));
$query->execute();
$info = $query->get_result()->fetch_assoc();
$interest = $info["PRODUCT_INTEREST"];
$each_service = explode(',', $interest);
$query->close();

//PRODUCT ID
$query = $dbconn->prepare("SELECT * FROM SUBSCRIBE WHERE COMPANY = ?");
$query->bind_param("i", getSession('id_company'));
$query->execute();
$querysubscribe = $query->get_result()->fetch_assoc();
$product_id = $querysubscribe['PRODUCT']; //ID PRODUCT
$query->close();

//BANDWIDTH AND STORAGE
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
$byte = $bytesumquery['JUMLAH']; //total usage
$query->close();

$remaining_bandwidth = ($bandwidth - $byte);

$query =  $dbconn->prepare("SELECT tb.START_TIME, tb.END_TIME, tb.COMPANY,
	SUM( IF( tb.SERVICE_NAME = 'Live Streaming', tb.BYTE, 0) ) AS LiveStreaming,
  SUM( IF( tb.SERVICE_NAME = 'Video Call', tb.BYTE, 0) ) AS VideoCall,
  SUM( IF( tb.SERVICE_NAME = 'Audio Call', tb.BYTE, 0) ) AS AudioCall,
  SUM( IF( tb.SERVICE_NAME = 'Unified Messaging', tb.BYTE, 0) ) AS UnifiedMessaging,
  SUM( IF( tb.SERVICE_NAME = 'Whiteboard', tb.BYTE, 0) ) AS Whiteboard,
  SUM( IF( tb.SERVICE_NAME = 'Screen Sharing', tb.BYTE, 0) ) AS ScreenSharing,
  SUM( IF( tb.SERVICE_NAME = 'Chatbot', tb.BYTE, 0) ) AS Chatbot
  FROM ( SELECT usg.ID, usg.COMPANY, usg.BYTE, usg.START_TIME, usg.END_TIME, srv.SERVICE_NAME FROM `USAGE` usg INNER JOIN COMPONENT cmp ON usg.COMPONENT=cmp.ID INNER JOIN SERVICE srv ON cmp.SERVICE=srv.ID WHERE usg.COMPANY = 146 ) tb
  GROUP BY tb.START_TIME;");

$query->bind_param("i", getSession('id_company'));
$query->execute();
$result = $query->get_result();
$query->close();

$ls_sum = 0;
$vc_sum = 0;
$ac_sum = 0;
$um_sum = 0;
$wb_sum = 0;
$ss_sum = 0;

foreach ($result as $row) {
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

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-9">
                    <div class="row">
                        <div class="col-xl-8 col-lg-12">
                            <h4 class="card-name"><strong>Account Overview<?php //foreach ($result as $row) { var_dump($row['START_TIME']); } 
                                                                            ?></strong></h4>
                            <div class="card" id="account">
                                <div class="row">
                                    <div class="col-md-6 text-center">
                                        <img class="profile-pic img-circle img-responsive mx-auto" src="assets/logomark_regular.png">
                                        <span class="josefin-sans text-center" id="overview-email"><strong><?php echo $itemUser['EMAIL_ACCOUNT']; ?></strong></span>
                                    </div>
                                    <div class="col-md-6 align-self-center">
                                        <ul class="josefin-sans mx-auto" id="service-info">
                                            <li>
                                                <strong>API key:</strong><br>
                                                <span class="api-key pull-left"><?php echo $itemUser['API_KEY']; ?></span>
                                                <button class="btn pull-left" id="copyapi" onclick="copyElementText()" type="button" name="button">
                                                    <i class="fa fa-copy"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <strong>Selected Service(s):</strong><br>
                                                <?php echo (strtoupper($interest)); ?>
                                            </li>
                                            <li>
                                                <strong>Status:</strong><br>
                                                <?php
                                                if ($itemUser2['STATUS'] == 1 && $itemUser2['PRODUCT'] == 1) {
                                                    echo "[ACTIVE] [Package: $50]";
                                                } else if ($itemUser2['STATUS'] == 1 && $itemUser2['PRODUCT'] == 2) {
                                                    echo "[ACTIVE] [Package: $75]";
                                                } else if ($itemUser2['STATUS'] == 1 && $itemUser2['PRODUCT'] == 3) {
                                                    echo "[ACTIVE] [Package: CUSTOM]";
                                                } else if ($itemUser2['STATUS'] == 0 && $itemUser2['PRODUCT'] == 1) {
                                                    echo "[SUSPENDED] [Package: $50]";
                                                } else if ($itemUser2['STATUS'] == 0 && $itemUser2['PRODUCT'] == 2) {
                                                    echo "[SUSPENDED] [Package: $75]";
                                                } else if ($itemUser2['STATUS'] == 0 && $itemUser2['PRODUCT'] == 3) {
                                                    echo "[SUSPENDED] [Package: CUSTOM]";
                                                } else {
                                                    echo "[TRIAL] [Package: TRIAL]";
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.col-md-6 -->
                        <div class="col-xl-4 col-lg-12">
                            <h4 class="card-name"><strong>Billing</strong></h4>
                            <div class="card" id="billing">
                                <div class="row mb-4">
                                    <div class="col-md-12 text-center">
                                        <img class="img-responsive mx-auto" src="assets/cost_saving@2x.png">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a class="btn btn-green" style="width: 100%; height:100%;" href="billpayment.php">$75.00</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="card-name"><strong>Recent Usage</strong></h4>
                            <div class="card card-info" id="recent-usage">
                                <div class="card-body">
                                    <canvas id="myUsage"></canvas>
                                    <span class="chart-info">Period: <span class="usage-period"><?php echo date("F Y"); ?></span></span>
                                    <span class="chart-info" style="float:right;">Total usage: <span class="usage-total"><?php echo ($byte != NULL ? $byte : "0"); ?> KB</span></span>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-lg-12">
                    <div class="card" id="docs">
                        <hr style="border-top: 10px solid white; border-radius:10px; width: 30%; margin: .5rem auto 1.25rem auto;">
                        <div class="card">
                            <h4 class="card-name text-center"><strong>Documentation</strong></h4>
                            <div id="accordion" class="mt-3">

                                <!-- Live Streaming -->
                                <div class="card">
                                    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_Live Streaming.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Live Streaming
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="../livestreaming_guide.php">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="../livestreaming_guide.php#sdk">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Chatbot -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_Chat-Bot.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Chatbot
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="#">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="#">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Unified Messaging -->
                                <div class="card">
                                    <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_UM.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Unified Messaging
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="../unifiedmessaging_guide.php">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="../unifiedmessaging_guide.php#sdk">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Screen Sharing -->
                                <div class="card">
                                    <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_Screensharing.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Screen Sharing
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="../screensharing_guide.php">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="../screensharing_guide.php#sdk">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Video Call -->
                                <div class="card">
                                    <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_Video Call.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Video Call
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="../videocall_guide.php">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="../videocall_guide.php#sdk">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Whiteboard -->
                                <div class="card">
                                    <div class="card-header" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_Whiteboarding.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Whiteboarding
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="../whiteboarding_guide.php">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="../whiteboarding_guide.php#sdk">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Audio Call -->
                                <div class="card">
                                    <div class="card-header" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        <div class="row">
                                            <div class="col-sm-3 col-3 text-center align-self-center">
                                                <img class="docs-icon" src="assets/icons_Whiteboarding.png">
                                            </div>
                                            <div class="col-sm-8 col-9 my-auto">
                                                Audio Call
                                                <i class="fas fa-chevron-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-8">
                                                    <ul class="docs-link">
                                                        <li>
                                                            <a href="../audiocall_guide.php">Quick Guide</a>
                                                        </li>
                                                        <li>
                                                            <a href="../audiocall_guide.php#sdk">SDK & Source Code</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>


<!-- ./wrapper -->



<script>
    $(document).ready(function() {
        $('a.nav-link[href="billpayment.php"]').removeClass('active');
        $('a.nav-link[href="index.php"]').addClass('active');
        $('a.nav-link[href="usage.php"]').removeClass('active');
        $('a.nav-link[href="support.php"]').removeClass('active');
    });

    var livestream = [<?php foreach ($result as $row) {
                            if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                                echo ($row['LiveStreaming'] . ",");
                            } else {
                                echo (0 . ",");
                            }
                        } ?>];
    console.log(livestream);
    var videocall = [<?php foreach ($result as $row) {
                            if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                                echo ($row['VideoCall'] . ",");
                            } else {
                                echo (0 . ",");
                            }
                        } ?>];
    var audiocall = [<?php foreach ($result as $row) {
                            if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                                echo ($row['AudioCall'] . ",");
                            } else {
                                echo (0 . ",");
                            }
                        } ?>];
    var um = [<?php foreach ($result as $row) {
                    if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                        echo ($row['UnifiedMessaging'] . ",");
                    } else {
                        echo (0 . ",");
                    }
                } ?>];
    // var chatbot = [];
    var ss = [<?php foreach ($result as $row) {
                    if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                        echo ($row['ScreenSharing'] . ",");
                    } else {
                        echo (0 . ",");
                    }
                } ?>];
    var wb = [<?php foreach ($result as $row) {
                    if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                        echo ($row['Whiteboard'] . ",");
                    } else {
                        echo (0 . ",");
                    }
                } ?>];
    var ctx = document.getElementById('myUsage');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($result as $row) {
                            if ($row['END_TIME'] > date("Y-m-d H:i:s")) {
                                echo ($row['START_TIME'] . ",");
                            }
                        } ?>],
            datasets: [{
                label: 'Live Streaming',
                backgroundColor: '#ED553B',
                borderColor: '#ED553B',
                data: livestream,
                fill: false
            }, {
                label: 'Video Call',
                backgroundColor: '#F6D55C',
                borderColor: '#F6D55C',
                data: videocall,
                fill: false
            }, {
                label: 'Audio Call',
                backgroundColor: '#3CAEA3',
                borderColor: '#3CAEA3',
                data: audiocall,
                fill: false
            }, {
                label: 'Unified Messaging',
                backgroundColor: '#20639B',
                borderColor: '#20639B',
                data: um,
                fill: false
            }, {
                label: 'Screen Sharing',
                backgroundColor: '#173F5F',
                borderColor: '#173F5F',
                data: ss,
                fill: false
            }, {
                label: 'Whiteboard',
                backgroundColor: '#9966FF',
                borderColor: '#9966FF',
                data: wb,
                fill: false
            }]
        },
        options: {
            // maintainAspectRatio: false,
            responsive: true,
            title: {
                display: false,
                text: 'Chart.js Line Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: false,
                        labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: false,
                    scaleLabel: {
                        display: true,
                        labelString: 'Value'
                    },
                    ticks: {
                        suggestedMin: 0
                    }
                }]
            }
        }
    });
</script>

<!-- OPTIONAL SCRIPTS -->
</body>

</html>