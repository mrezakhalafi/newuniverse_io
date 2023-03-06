<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/headerdashboard.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/url_function.php');?>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/db_conn.php');?>
<?php 

    session_start();
    $email = getSession('email');
    $id_company = getSession('id_company');
    $id_user = getSession('id_user');

    if(isset($_POST['submit'])){
    
        $dbconn = getDBConn();
        $summary = $_POST['summary'];
        $method = $_POST['method'];
        $detail = $_POST['detail'];

        //TICKET INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO TICKET (CREATED_TIME, CREATED_BY, SUMMARY, METHOD, DETAIL) VALUES (NOW(), ?, ?, ?, ?)");
        $query->bind_param("isss", $id_user, $summary, $method, $detail);
        $query->execute();
        $query->close();

        //SELECT TICKET NUMBER
        $query = $dbconn->prepare("SELECT * FROM TICKET WHERE CREATED_BY = ? ORDER BY TICKET_NUMBER DESC LIMIT 1");
        $query->bind_param("i", $id_user);
        $query->execute();
        $ticket_number = $query->get_result()->fetch_assoc();
        $query->close();

        $general = (int)$_POST['general'];
        $live_stream = (int)$_POST['livestreaming'];
        $video_call = (int)$_POST['videocall'];
        $audio_call = (int)$_POST['audiocall'];
        $screen_sharing = (int)$_POST['screensharing'];
        $whiteboarding = (int)$_POST['whiteboarding'];
        $unified_messaging = (int)$_POST['unifiedmessaging'];
        $chatbot = (int)$_POST['chatbot'];

        //SDK INSERT QUERY
        $query = $dbconn->prepare("INSERT INTO SDK (TICKET_NUMBER, GENERAL, LIVE_STREAMING, VIDEO_CALL, AUDIO_CALL, SCREEN_SHARING, WHITEBOARDING, UNIFIED_MESSAGING, CHATBOT) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("iiiiiiiii", $ticket_number['TICKET_NUMBER'], $general, $live_stream, $video_call, $audio_call, $screen_sharing, $whiteboarding, $unified_messaging, $chatbot);
        $query->execute();
        $query->close();

    }

    //SELECT * TICKET
    $query = $dbconn->prepare("SELECT * FROM TICKET WHERE CREATED_BY = ?");
    $query->bind_param("i", $id_user);
    $query->execute();
    $tickets = $query->get_result();
    $query->close();

    //SELECT USER_NAME TICKET
    $query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE ID = ?");
    $query->bind_param("i", $id_user);
    $query->execute();
    $username = $query->get_result()->fetch_assoc();
    $query->close();

?>

<style>
    * {
    box-sizing: border-box;
    }

    input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    }

    label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    }

    input[type=submit] {
    background-color: #01686d;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
    }

    input[type=submit]:hover {
    background-color: #fff;
    border-color: #01686d;
    color: #01686d;
    }

    .container {
    border-radius: 5px;
    padding: 20px;
    }

    .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
    }

    .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-3">

  <div class="container px-1">

    <div class="card m-3">
      <div class="card-body">
      <span class="ml-1 fs-14 fc-70"><b>Recent Tickets</b></span><br><hr>
        <div class="row m-0" style="overflow-x: auto;">
          <table id="" class="table w-100">
            <thead>
              <tr style="background-color: #f2f2f2;">
                <th scope="col" class="fs-14">Ticket Number</th>
                <th scope="col" class="fs-14">Created Time</th>
                <th scope="col" class="fs-14">Created By</th>
                <th scope="col" class="fs-14">Summary</th>
                <th scope="col" class="fs-14">Status</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($tickets as $ticket){ ?>
                <tr>
                    <td class="fs-12">
                        <?php echo $ticket['TICKET_NUMBER']; ?>
                    </td>
                    <td class="fs-12">
                        <?php echo $ticket['CREATED_TIME']; ?>
                    </td>
                    <td class="fs-12">
                        <?php echo $username['USERNAME']; ?>
                    </td>
                    <td class="fs-12">
                        <?php echo $ticket['SUMMARY']; ?>
                    </td>
                    <td class="fs-12">
                        <?php echo $ticket['STATUS']; ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card m-3">
        <div class="card-body">
            <span class="ml-1 fs-14 fc-70"><b>Create Ticket</b></span><br><hr>
            <div class="container">
                <form method="POST" id="ticket">
                    <div class="row">
                        <div class="col-25">
                            <label for="summary">Summary</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="summary" name="summary" placeholder="Insert your problem summary..">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Development Method</label>
                        </div>
                        <div class="col-75">
                            <input type="radio" name="method" value="flutter"> Flutter<br>
                            <input type="radio" name="method" value="native"> Native Android<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="country">SDK/API</label>
                        </div>
                        <div class="col-75">
                            <input type="checkbox" name="general" value="1"> General<br>
                            <input type="checkbox" name="livestreaming" value="1"> Live Streaming<br>
                            <input type="checkbox" name="videocall" value="1"> Video Call<br>
                            <input type="checkbox" name="audiocall" value="1"> Audio Call<br>
                            <input type="checkbox" name="screensharing" value="1"> Screen Sharing<br>
                            <input type="checkbox" name="whiteboarding" value="1"> White Boarding<br>
                            <input type="checkbox" name="unifiedmessaging" value="1"> Unified Messaging<br>
                            <input type="checkbox" name="chatbot" value="1"> Chatbot<br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="detail">Detailed Description</label>
                        </div>
                        <div class="col-75">
                            <textarea id="detail" name="detail" placeholder="Insert your problem detail.." style="height:200px"></textarea>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <input type="submit" value="Submit">
                    </div> -->
                    <input type="submit" class="btn nav-menu-btn-wht-alt py-1 px-3 w-100 m-0 my-4 fs-16" value="submit" name="submit">
                </form>
            </div>

        </div>
    </div>
    
  </div>

</div>

<script type="text/javascript">
		$('.nav-dashboard.sup').addClass('active');
	</script>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footerdashboard.php'); ?>
