<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>

<?php

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$id_company = getSession('id_company');

$today = date("Y-m-d H:i:s");
$query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc limit 1");
$query->bind_param("i", $id_company);
$query->execute();
$billing = $query->get_result()->fetch_assoc();
$due_date = $billing["DUE_DATE"];
$charge = $billing['CHARGE'];
$query->close();

if (isset($_GET['startDate'])) {
    $startdate = $_GET['startDate'];
    $untildate = $_GET['endDate'];
    $table_name = "NUs Billing_" . $startdate . "_" . $untildate;
} else {
    $startdate = "2020-01-01";
    $untildate = date("Y-m-d");
    $table_name = "NUs Billing_" . $startdate . "_" . $untildate;
}

if (isset($_GET['startDate'])) {
    $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? and DUE_DATE between ? and ? order by DUE_DATE desc");
    $query->bind_param("iss", $id_company, $_GET['startDate'], $_GET['endDate']);
    $query->execute();
    $bills = array();
    $bills = $query->get_result(); //GET COLUMNS
    $query->close();
} else {
    $query = $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc");
    $query->bind_param("i", $id_company);
    $query->execute();
    $bills = array();
    $bills = $query->get_result(); //GET COLUMNS
    $query->close();
}

//TOTAL BILL
$query = $dbconn->prepare("SELECT SUM(CHARGE) AS TOTAL FROM BILLING WHERE COMPANY = ? AND IS_PAID = 0");
$query->bind_param("i", $id_company);
$query->execute();
$total_bill = $query->get_result()->fetch_assoc(); //GET COLUMNS
$query->close();

//ISSUE DATE
$query = $dbconn->prepare("SELECT BILL_DATE FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc");
$query->bind_param("i", $id_company);
$query->execute();
$bill_date_array = $query->get_result()->fetch_assoc();
$bill_date = $bill_date_array['BILL_DATE'];
$query->close();

$query = $dbconn->prepare("SELECT * FROM CREDIT WHERE USER_ID = ?");
$query->bind_param("i", $id_company);
$query->execute();
$credit = $query->get_result()->fetch_assoc();
$query->close();

if (isset($_POST['submit'])) {
    setSession('bill_id', $_POST['bill_id']);
    redirect(base_url() . 'dashboardv2/template/billing.php');
}

$version = 'v=1.72';

?>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
    body{
        font-family: 'Poppins',sans-serif;
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }
</style>

<title>Palio | Bill & Payment</title>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-name" style="font-size: 1.75rem"><strong data-translate="dashbill-1">Bill & Payment</strong></h4>
                    <div class="card" id="payments">
                        <div class="row">
                            <div class="col-md-12">
                                <h6><strong data-translate="dashbill-2">Payments</strong></h6>
                                <ul style="font-size:14px">
                                    <li data-translate="dashbill-3">
                                        Your monthly billing will be available on the 1st date of each month.
                                    </li>
                                    <li data-translate="dashbill-4">
                                        Your balance will be deducted by the billing amount of each month.
                                    </li>
                                    <li data-translate="dashbill-5">
                                        By default, if your balance remains negative for over 30 days, your account will be suspended according to the terms of service.
                                    </li>
                                    <li data-translate="dashbill-6">
                                        Access to all projects will be disabled if your account is suspended, however you can still log in to the dashboard to make the payment.
                                    </li>
                                    <li data-translate="dashbill-7">
                                        Once all dues are paid via the preferred method of payment, your account will be resumed immediately.
                                    </li>
                                    <li data-translate="dashbill-8">
                                        All payment notifications including monthly billing payments, refunds/credit, account suspensions and account summary will be notified via email or text message.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 4px solid black;">
            <div class="row">
                <div class="col-md-5">
                    <div class="card" id="total-bill">
                        <h3 class="card-name"><strong data-translate="dashbill-9">Total Bill</strong></h3>
                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <?php if ($total_bill['TOTAL'] != NULL) { ?>
                                    <?php echo "<h2><strong>$" . $total_bill['TOTAL'] . "</h2></strong>"; ?>
                                    <a type="button" href="<?php echo base_url() . "checkout.php" ?>" class="btn btn-yellow mb-3" style="border-radius: 15px;">
                                        <span style="font-size:1.2rem;"><strong data-translate="dashbill-16">
                                                PAY NOW
                                            </strong></span>
                                    </a><br>
                                <?php } else {
                                    echo "<h1><strong data-translate='dashbill-15'>No unpaid bills</h1></strong>";
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card" id="bills">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <button class="btn btn-green-1" type="submit" id="exportCSV" name="export" style="border-radius:30px; font-size:.85rem" data-translate="dashbill-11">
                                    Export to CSV
                                </button>
                                <input class="form-control" id="search-mbl" type="text" placeholder="Search by period..." style="max-width:150px; font-size:.75rem" />
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="search-bill" type="text" placeholder="Search by period..." style="font-size:.75rem"/>
                            </div>
                        </div>
                        <?php foreach ($bills as $ind => $bill) {
                            if ($bills->num_rows == 1 && $bill['CHARGE'] == 0) { ?>
                                <div class="row mt-5">
                                    <div class="col-md-12 text-center">
                                        <h1><strong>No data</h1></strong>
                                    </div>
                                </div>
                            <?php continue;
                            } else if ($bill['CHARGE'] == 0) {
                                continue;
                            } ?>

                            <div class="row mt-4 pb-2 monthly-bill">
                                <div class="col-md-6">
                                    <span class="month-year"><strong id="registerDate-<?= $ind; ?>" style="font-size: 1rem"><?php echo date("F Y", strtotime($bill['BILL_DATE'])); ?></strong></span><br>
                                    <?php if ($bill['IS_PAID'] == 1) { ?>
                                        <button class=" my-1 btn-green">
                                            <span style="color:#00ff00;">&#9679;</span><span style="font-size:.85rem" data-translate="dashbill-13">Paid</span>
                                        </button>
                                    <?php } else { ?>
                                        <button class=" my-1 btn-green">
                                            <span style="color:#ff0000;">&#9679;</span><span style="font-size:.85rem" data-translate="dashbill-14">Unpaid</span>
                                        </button>
                                    <?php } ?>
                                    <br>
                                    <span style="font-size: 14px"><span data-translate="dashbill-12">Due on</span> <span id="expDate-<?= $ind; ?>"><?php echo date("F d, Y", strtotime($bill['DUE_DATE'])); ?></span></span>
                                </div>
                                <div class="col-md-6 text-right align-self-center">
                                    <h6><strong><?php echo ((($bill['CURRENCY'] == 'USD') ? '$' : 'Rp ') . '<span class="billAmount">' . $bill['CHARGE'] . '</span>'); ?></strong></h6>
                                    <form method="POST">
                                        <input type="hidden" name="bill_id" value="<?php echo $bill['ID']; ?>" class="fas fa-download">
                                        <input type="submit" id="submit" name="submit" value="submit" style="display: none;">
                                    </form>
                                    <button class="btn-see-details" onclick="dl_invoice();" style="background-color: DodgerBlue; border: none; color: white; padding: 5px; padding-left: 10px; padding-right: 10px; font-size: 14px; border-radius: 20px">
                                        <!-- <i class="fas fa-download"></i> -->
                                        See Details
                                    </button>
                                </div>
                            </div>

                        <?php } ?>
                        <!-- <div class="row show-less">
                            <div class="col-md-12 text-center">
                                <button class="btn mt-2" id="show-less">
                                    Show Less
                                    <i class="fas fa-chevron-circle-up" style="color: #007a87;"></i>
                                </button>
                            </div>
                        </div> -->
                    </div>

                    <table id="bills-csv" class="table table-bordered table-striped" style="display:none;">
                        <thead>
                            <tr>
                                <th>Issue Date</th>
                                <th>Billing Period</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bills as $bill) {
                                if ($bill['CHARGE'] > 0) { ?>
                                    <tr>
                                        <td><?php print_r($bill['BILL_DATE']); ?> <br></td>
                                        <td>
                                            <?php
                                            //BILLING PERIOD
                                            $issue_date = strtotime($bill['BILL_DATE']);
                                            $secs = strtotime(date("Y-m-d H:i:s")) - $issue_date; // == <seconds between the two times>
                                            $billing_period = $secs / 86400;
                                            // $int = int($billing_period);
                                            if (floor($billing_period) < 0) {
                                                echo ("1");
                                            } else {
                                                echo (floor($billing_period) + 1);
                                            }
                                            ?>
                                        </td>
                                        <td><?php print_r($bill['DUE_DATE']); ?></td>
                                        <td><?php echo ((($credit['CURRENCY'] == 'USD') ? '$' : 'Rp') .  $bill['CHARGE']); ?></td>
                                        <td><?php if ($bill['IS_PAID'] == 1) {
                                                echo ("PAID");
                                            } else {
                                                echo ("UNPAID");
                                            } ?></td>
                                        <td>
                                            <?php
                                            if ($bill['IS_PAID'] == 0) {
                                                echo '<a href="checkout.php?company=' . $_SESSION['id_company'] . '&bill=' . $bill['ID'] . '" class="btn fs-12 text-light py-1" style="background-color: #F7941F;">Pay</a>';
                                            } elseif ($bill['IS_PAID'] == 1) {
                                                echo '-';
                                            } elseif ($bill['IS_PAID'] == 2) {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Issue Date</th>
                                <th>Billing Period</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <form method="GET" action="blog_search.php"> -->
            <!-- <div class="modal-header">
            </div> -->
            <div class="modal-body">

                <input class="form-control py-2 border-right-0 border" name="qm" type="text" placeholder="Search bills..." id="example-search-input">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size:1rem;">Close</button>
                <button type="submit" class="btn btn-blog">Search</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script src='js/billpayment_raw.js?<?php echo $version; ?>'></script>

<script>
    var _0x1a68=['css','100256JyvsHg','745lMONsm','415931OifbdN','a.nav-link[href=\x22billpayment.php\x22]','removeClass','#bills\x20.bills-more','263cTsCHp','active','display','block','537038ORKvNv','#show-less','56909QpVzgl','a.nav-link[href=\x22mailbox.php\x22]','#submit','#bills\x20.show-more,\x20.show-more\x20#show-more','1637qZneJQ','14312yRgYJd','1303olBKdD','5TSfvQP','click','#show-more','7LMNyKO','1CqrHiQ'];var _0x1535=function(_0x313b75,_0x1d41bf){_0x313b75=_0x313b75-0x113;var _0x1a6842=_0x1a68[_0x313b75];return _0x1a6842;};var _0x2f1152=_0x1535;(function(_0x246c2e,_0x4cbf8a){var _0x5ca7d=_0x1535;while(!![]){try{var _0x35a19f=-parseInt(_0x5ca7d(0x124))+parseInt(_0x5ca7d(0x126))*parseInt(_0x5ca7d(0x122))+-parseInt(_0x5ca7d(0x115))+parseInt(_0x5ca7d(0x12a))*-parseInt(_0x5ca7d(0x11d))+parseInt(_0x5ca7d(0x117))*-parseInt(_0x5ca7d(0x11e))+-parseInt(_0x5ca7d(0x121))*parseInt(_0x5ca7d(0x11c))+parseInt(_0x5ca7d(0x11b))*parseInt(_0x5ca7d(0x125));if(_0x35a19f===_0x4cbf8a)break;else _0x246c2e['push'](_0x246c2e['shift']());}catch(_0x13c0f8){_0x246c2e['push'](_0x246c2e['shift']());}}}(_0x1a68,0x421c0));function dl_invoice(){var _0x192b22=_0x1535;$(_0x192b22(0x119))[_0x192b22(0x11f)]();};$(_0x2f1152(0x120))[_0x2f1152(0x11f)](function(){var _0x258e6f=_0x2f1152;$(this)['css'](_0x258e6f(0x113),'none'),$(_0x258e6f(0x129))['css'](_0x258e6f(0x113),_0x258e6f(0x114));}),$(_0x2f1152(0x116))['click'](function(){var _0x1c679e=_0x2f1152;$(_0x1c679e(0x129))[_0x1c679e(0x123)](_0x1c679e(0x113),'none'),$(_0x1c679e(0x11a))[_0x1c679e(0x123)](_0x1c679e(0x113),_0x1c679e(0x114));}),$(_0x2f1152(0x127))['addClass'](_0x2f1152(0x12b)),$('a.nav-link[href=\x22index.php\x22]')[_0x2f1152(0x128)]('active'),$('a.nav-link[href=\x22usage.php\x22]')[_0x2f1152(0x128)](_0x2f1152(0x12b)),$('a.nav-link[href=\x22support.php\x22]')[_0x2f1152(0x128)](_0x2f1152(0x12b)),$(_0x2f1152(0x118))[_0x2f1152(0x128)](_0x2f1152(0x12b));

    window.onload = function() {
        <?php if ($billing['CURRENCY'] == 'IDR') { ?>
            var _0x1e26=['2RpuwTG','text','676079JOXcOe','67266GHJMIy','.billAmount','toLocaleString','each','965054XURXkZ','1428259VJUpSg','114809czvzxk','1755273fCoTtp','2788367QLQyAv','28oKhaNr'];var _0x3e55=function(_0x439b30,_0xc0589f){_0x439b30=_0x439b30-0xb1;var _0x1e2665=_0x1e26[_0x439b30];return _0x1e2665;};var _0x177e99=_0x3e55;(function(_0x1349a4,_0x288608){var _0xae841a=_0x3e55;while(!![]){try{var _0x3eda73=parseInt(_0xae841a(0xb9))*parseInt(_0xae841a(0xbd))+-parseInt(_0xae841a(0xb7))+-parseInt(_0xae841a(0xb5))+-parseInt(_0xae841a(0xb4))+parseInt(_0xae841a(0xb6))*-parseInt(_0xae841a(0xba))+parseInt(_0xae841a(0xbc))+parseInt(_0xae841a(0xb8));if(_0x3eda73===_0x288608)break;else _0x1349a4['push'](_0x1349a4['shift']());}catch(_0x5f364e){_0x1349a4['push'](_0x1349a4['shift']());}}}(_0x1e26,0xecbda),$(_0x177e99(0xb1))[_0x177e99(0xb3)](function(_0x34367b,_0x3acf0d){var _0x471615=_0x177e99;$(this)['text'](parseFloat($(this)[_0x471615(0xbb)]())[_0x471615(0xb2)]('id',{'minimumFractionDigits':0x2,'maximumFractionDigits':0x2}));}));
        <?php } else if ($billing['CURRENCY'] == 'USD') { ?>
            var _0x4420=['11hkYdjm','text','.billAmount','829YpVFEg','27ekeNoB','29628gMJNLD','67JsIavA','33232McISYY','67534QYxFPm','37947kwPvrv','4283wViOIR','332960bzTfEY','en-US','toLocaleString'];var _0x1b20=function(_0x21d7ba,_0x2296f9){_0x21d7ba=_0x21d7ba-0xf3;var _0x442051=_0x4420[_0x21d7ba];return _0x442051;};var _0x5a552e=_0x1b20;(function(_0x3ae1ad,_0x49b331){var _0x55fb10=_0x1b20;while(!![]){try{var _0x4c623b=parseInt(_0x55fb10(0xfa))*parseInt(_0x55fb10(0xf6))+parseInt(_0x55fb10(0xf7))+-parseInt(_0x55fb10(0xf8))+parseInt(_0x55fb10(0xf5))*parseInt(_0x55fb10(0xfe))+-parseInt(_0x55fb10(0xf4))*parseInt(_0x55fb10(0xf3))+-parseInt(_0x55fb10(0xfb))+-parseInt(_0x55fb10(0xf9));if(_0x4c623b===_0x49b331)break;else _0x3ae1ad['push'](_0x3ae1ad['shift']());}catch(_0xe3dcb8){_0x3ae1ad['push'](_0x3ae1ad['shift']());}}}(_0x4420,0x2d3bd),$(_0x5a552e(0x100))['each'](function(_0x5ef069,_0x5ee4a0){var _0x4b0484=_0x5a552e;$(this)['text'](parseFloat($(this)[_0x4b0484(0xff)]())[_0x4b0484(0xfd)](_0x4b0484(0xfc),{'minimumFractionDigits':0x2,'maximumFractionDigits':0x2}));}));
        <?php } else { ?>
            var _0x5d9a=['39UUxkIy','text','country_code','.billAmount','1467555FcyAHP','toLocaleString','5551JdZxAV','423481hDyopv','147702ZWpeIo','2hRSGhp','740314wFOHVk','855120kGEeqt','2SEjVLv','en-US','83770NcBNJu'];var _0x5e7a=function(_0x91a60,_0x5048d4){_0x91a60=_0x91a60-0x1a2;var _0x5d9a36=_0x5d9a[_0x91a60];return _0x5d9a36;};var _0x560ce0=_0x5e7a;(function(_0x17bc01,_0x4abf58){var _0x44af16=_0x5e7a;while(!![]){try{var _0x24b658=parseInt(_0x44af16(0x1aa))+-parseInt(_0x44af16(0x1af))*parseInt(_0x44af16(0x1a5))+parseInt(_0x44af16(0x1a6))*parseInt(_0x44af16(0x1ac))+parseInt(_0x44af16(0x1ae))+-parseInt(_0x44af16(0x1b0))+-parseInt(_0x44af16(0x1a3))*-parseInt(_0x44af16(0x1ad))+-parseInt(_0x44af16(0x1a2));if(_0x24b658===_0x4abf58)break;else _0x17bc01['push'](_0x17bc01['shift']());}catch(_0x2c7c57){_0x17bc01['push'](_0x17bc01['shift']());}}}(_0x5d9a,0xdf916));if(localStorage[_0x560ce0(0x1a8)]=='ID')$(_0x560ce0(0x1a9))['each'](function(_0x820cdf,_0x3d9389){var _0x2b0afb=_0x560ce0;$(this)[_0x2b0afb(0x1a7)](parseFloat($(this)[_0x2b0afb(0x1a7)]())[_0x2b0afb(0x1ab)]('id',{'minimumFractionDigits':0x2,'maximumFractionDigits':0x2}));});else localStorage['country_code']!='ID'&&$(_0x560ce0(0x1a9))['each'](function(_0xc874ea,_0x5b2966){var _0x14c464=_0x560ce0;$(this)[_0x14c464(0x1a7)](parseFloat($(this)[_0x14c464(0x1a7)]())[_0x14c464(0x1ab)](_0x14c464(0x1a4),{'minimumFractionDigits':0x2,'maximumFractionDigits':0x2}));});
        <?php } ?>
    }

    // $('#lang-nav').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });

    // $('#lang-menu').hover(function(){
    //     $('#lang-menu').dropdown("show");
    //     }, function(){
    //     $('#lang-menu').dropdown("hide");
    // });
    
    if (localStorage.lang == 1){

        <?php
            function indoDate($tanggal){
                $bulan = array (
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
                );
                $pecahkan = explode('-', $tanggal);
                return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            }
        ?>

        var idID = 0;

        $('#search-bill').attr('placeholder','Cari berdasarkan periode...');
        $('#search-mbl').attr('placeholder','Cari berdasarkan periode...');
        $('.btn-see-details').text('Lihat Detail');

        <?php
            foreach ($bills as $bill) {
                ?>
                var regDate = '<?php echo indoDate(date('Y-m', strtotime($bill['BILL_DATE']))); ?>';
                var expDate = '<?php echo indoDate(date("Y-m-d", strtotime($bill['DUE_DATE']))); ?>';
                $("#registerDate-"+idID).text(regDate);
                $("#expDate-"+idID).text(expDate);
                idID = idID + 1;
                <?php
            }
        ?>
    }

    $("#change-lang-EN").click(function () {
		localStorage.lang = 0;
        var idID = 0;

		$("#lang-nav").text('EN');
        $('#search-bill').attr('placeholder','Search by period...');
        $('#search-mbl').attr('placeholder','Search by period...');
        $('.btn-see-details').text('See Details');

        <?php
            foreach ($bills as $bill) {
                ?>
                var regDate = '<?php echo date("F Y", strtotime($bill['BILL_DATE'])); ?>';
                var expDate = '<?php echo date("F d, Y", strtotime($bill['DUE_DATE'])); ?>';
                $("#registerDate-"+idID).text(regDate);
                $("#expDate-"+idID).text(expDate);
                idID = idID + 1;
                <?php
            }
        ?>
		change_lang();
	});

	$("#change-lang-ID").click(function () {

        <?php
            function dateIndo($tanggal){
                $bulan = array (
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
                );
                $pecahkan = explode('-', $tanggal);
                return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            }
        ?>

        var idID = 0;
		localStorage.lang = 1;
        
		$("#lang-nav").text('ID');
        $('#search-bill').attr('placeholder','Cari berdasarkan periode...');
        $('#search-mbl').attr('placeholder','Cari berdasarkan periode...');
        $('.btn-see-details').text('Lihat Detail');

        <?php
            foreach ($bills as $bill) {
                ?>
                var regDate = '<?php echo dateIndo(date('Y-m', strtotime($bill['BILL_DATE']))); ?>';
                var expDate = '<?php echo dateIndo(date("Y-m-d", strtotime($bill['DUE_DATE']))); ?>';
                $("#registerDate-"+idID).text(regDate);
                $("#expDate-"+idID).text(expDate);
                idID = idID + 1;
                <?php
            }
        ?>
		change_lang();
	}); 

</script>