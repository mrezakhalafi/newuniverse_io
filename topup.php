<?php session_start(); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>

<?php

if (!isset($_SESSION["id_user"]) || !isset($_SESSION["id_company"])) {
    redirect(base_url());
    die();
}

$js_version = 'v=' . time();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 12;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$dbconn = getDBConn();
$company_id = $_SESSION['id_company'];

$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT WHERE COMPANY = ?");
$query->bind_param("i", $company_id);
$query->execute();
$dataUser = $query->get_result()->fetch_assoc();
$password = MD5($dataUser['PASSWORD']);
$user_id = $dataUser['ID'];
$email = $dataUser['EMAIL_ACCOUNT'];
$payStatus = $dataUser["STATUS"];
$userState = $dataUser["STATE"];
$userActive = $dataUser["ACTIVE"];
$query->close();

if (isset($_POST['submitLogout'])) {
    session_destroy();
    header("Location: index.php");
}

if ($payStatus == 0 || $payStatus == 3 || $userState != 3 || $userActive == 0) {
    redirect(base_url());
}

$query = $dbconn->prepare("SELECT * FROM CREDIT WHERE USER_ID = ?");
$query->bind_param("i", $_SESSION['id_user']);
$query->execute();
$credit = $query->get_result()->fetch_assoc();
$currencyBill = $credit['CURRENCY'];
$currCredit = $credit['CREDIT'];
$query->close();

//check order number availability
do {
    $bytes = random_bytes(8);
    $hexbytes = strtoupper(bin2hex($bytes));
    $order_number = substr($hexbytes, 0, 15);

    $query = $dbconn->prepare("SELECT COUNT(*) as counter_bill FROM BILLING WHERE ORDER_NUMBER = ?");
    $query->bind_param("s", $order_number);
    $query->execute();
    $counter = $query->get_result()->fetch_assoc();
    $counter_bill = $counter['counter_bill'];
    $query->close();
} while ($counter_bill > 0);

echo "<script>transaction_id = '" . $order_number . "';</script>";
echo "<script>company_id = " . $company_id . ";</script>";
echo "<script>topup = 1;</script>";

if (isset($_POST['dashboard'])) {
    $dbconn = getDBConn();
    $amount = sprintf('%0.2f', $_POST['amount']);

    //TOPUP INSERT QUERY
    $query = $dbconn->prepare("INSERT INTO TOPUP (USER_ID, CURRENCY, AMOUNT, ORDER_NUMBER) VALUES (?, ?, ?, ?)");
    $query->bind_param("isds", $user_id, $currencyBill, $amount, $order_number);
    $query->execute();
    $query->close();

    $creditSum = $currCredit + $amount;
    $prepaid_quota = $creditSum / 0.000265;

    $query = $dbconn->prepare("UPDATE CREDIT SET CREDIT = ?, PREPAID_QUOTA = ? WHERE COMPANY_ID = ?");
    $query->bind_param("ddi", $creditSum, $prepaid_quota, $company_id);
    $query->execute();
    $query->close();

    function invoiceMail($name, $orderNumber, $orderDate, $price, $method, $dashboard)
    {
        $item = "Top Up " . $price . " Credit";
        $content = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/template/Payment_copy_01.html');
        $content = str_replace('*NAME*', $name, $content);
        $content = str_replace('*AMOUNT*', $price, $content);
        $content = str_replace('1A2B3C4D5EFFF', $orderNumber, $content);
        $content = str_replace('April 28, 2020', $orderDate, $content);
        $content = str_replace('ITEM1', $item, $content);
        $content = str_replace('$75', $price, $content);
        $content = str_replace('BCA: **** 5808', $method, $content);
        $content = str_replace('http://103.94.169.26:8081/', $dashboard, $content);
        return $content;
    }

    $name = $dataUser['USERNAME'];
    $orderDate = date("F d, Y");
    $method = 'PAYPAL';
    $dashboard = base_url();
    $content = invoiceMail($name, $order_number, $orderDate, $currencyBill . ' ' . $amount, $method, $dashboard);

    // EMAIL
    $lowerCaseMail = strtolower($email);
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support@palio.io';
    $mail->Password   = '12345easySoft67890';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('support@palio.io', 'Palio');
    $mail->addAddress($lowerCaseMail);
    $mail->addReplyTo('support@palio.io');

    $mail->isHTML(true);
    $mail->Subject = 'Top Up Submission';
    $mail->Body = $content;
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/template/PalioEmailConfirmation_files/image003.png', 'ccimage', 'images003.png');
    $mail->AddEmbeddedImage($_SERVER['DOCUMENT_ROOT'] . '/new_palio_logo.png', 'logoimage', 'logo.png');

    if (!$mail->send()) {
        $succMsg = "";
        $mail->ClearAllRecipients();
        $msg = 'Error Mailler: ' . $mail->ErrorInfo;
        echo $msg;
    } else {
        $mail->ClearAllRecipients();
        $sent = true;
        setSession('order_number', $order_number);
        redirect(base_url() . 'status/palio/status.php');
    }
}

function monthFormat($month)
{

    if ($month == 1) {
        return "Januari";
    } else if ($month == 2) {
        return "Februari";
    } else if ($month == 3) {
        return "Maret";
    } else if ($month == 4) {
        return "April";
    } else if ($month == 5) {
        return "Mei";
    } else if ($month == 6) {
        return "Juni";
    } else if ($month == 7) {
        return "Juli";
    } else if ($month == 8) {
        return "Agustus";
    } else if ($month == 9) {
        return "September";
    } else if ($month == 10) {
        return "Oktober";
    } else if ($month == 11) {
        return "November";
    } else if ($month == 12) {
        return "Desember";
    }

    // return $month;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Top Up Credit</title>
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- jQuery 3 -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">
    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css?<?php echo ($version); ?>" rel="stylesheet">
    <script src="<?php echo base_url(); ?>bower_components/bootstrap/dist/js/bootstrap.min.js?<?php echo ($version); ?>"></script>

    <!-- Global site tag (gtag.js) - Google Ads: 689853920 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-689853920"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'AW-689853920');
    </script>

    <!-- Xendit.js -->
    <script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>
    <script type="text/javascript" src="./payment_xendit.js?<?php echo ($js_version); ?>"></script>

    <script src="https://www.paypal.com/sdk/js?client-id=AaIDxN07-OfsTeeqPXhMG-BpfLAVhBah94jfutKGersh9uIKkU5kgupWXiWRDxtfsnFF1rnjYTCeNGCi&currency=USD" data-sdk-integration-source="button-factory"></script>


    <script>
        <?php if ($geolocSts == 1) { ?>

            var _0x71d3 = ['lang', 'https://api.ipgeolocation.io/ipgeo?apiKey=cacef90bd1af48e5a4e0a97e91439f51', 'lastCheck', 'prevGeoloc', '33274vpNuAb', 'country_code', '4980616OFFoOz', '914DRDVNE', 'switchLang', '282590khnngw', 'removeItem', '657143dDDjDE', '1313863qaJEoz', 'lang_visible', '49lrHAZr', 'country_code2', 'currentGeoloc', 'floor', '1DkWrmN', 'undefined', '1272623MVTMuX', 'prevCountry', 'ajax', '1197kAwtKu', 'now', 'Sorry,\x20we\x20are\x20unable\x20to\x20get\x20your\x20current\x20location.'];
            var _0x424e = function(_0x1bbcc1, _0x3bbb63) {
                _0x1bbcc1 = _0x1bbcc1 - 0x150;
                var _0x71d32d = _0x71d3[_0x1bbcc1];
                return _0x71d32d;
            };
            var _0x4d98a0 = _0x424e;
            (function(_0x32a3a7, _0x36a1eb) {
                var _0x4633dc = _0x424e;
                while (!![]) {
                    try {
                        var _0x468f39 = -parseInt(_0x4633dc(0x162)) + -parseInt(_0x4633dc(0x15f)) + parseInt(_0x4633dc(0x15d)) * parseInt(_0x4633dc(0x153)) + parseInt(_0x4633dc(0x161)) * -parseInt(_0x4633dc(0x168)) + parseInt(_0x4633dc(0x164)) * -parseInt(_0x4633dc(0x15a)) + -parseInt(_0x4633dc(0x150)) + parseInt(_0x4633dc(0x15c));
                        if (_0x468f39 === _0x36a1eb) break;
                        else _0x32a3a7['push'](_0x32a3a7['shift']());
                    } catch (_0x1a3820) {
                        _0x32a3a7['push'](_0x32a3a7['shift']());
                    }
                }
            }(_0x71d3, 0xe020d), localStorage[_0x4d98a0(0x159)] = localStorage['currentGeoloc'], localStorage[_0x4d98a0(0x166)] = 'ON', localStorage['removeItem'](_0x4d98a0(0x15e)));

            function geoLoc() {
                var _0x41b74a = _0x4d98a0;
                $[_0x41b74a(0x152)]({
                    'url': _0x41b74a(0x157),
                    'type': 'GET',
                    'success': function(_0x20c0d4) {
                        var _0x25af1b = _0x41b74a;
                        console['log']('checking\x20loc'), localStorage[_0x25af1b(0x151)] = localStorage[_0x25af1b(0x15b)], localStorage[_0x25af1b(0x158)] = Math[_0x25af1b(0x167)](Date[_0x25af1b(0x154)]() / 0x3e8), (localStorage[_0x25af1b(0x151)] != _0x20c0d4[_0x25af1b(0x165)] || localStorage[_0x25af1b(0x151)] == null || typeof localStorage[_0x25af1b(0x151)] === _0x25af1b(0x169)) && (localStorage[_0x25af1b(0x15b)] = _0x20c0d4['country_code2'], _0x20c0d4[_0x25af1b(0x165)] == 'ID' ? (localStorage[_0x25af1b(0x163)] = 0x1, (localStorage[_0x25af1b(0x156)] != null || typeof localStorage[_0x25af1b(0x156)] !== _0x25af1b(0x169)) && (localStorage[_0x25af1b(0x156)] = 0x0)) : (localStorage[_0x25af1b(0x156)] = 0x0, localStorage[_0x25af1b(0x163)] = 0x0));
                    },
                    'error': function(_0x4f7a43) {
                        var _0x86c97d = _0x41b74a;
                        alert(_0x86c97d(0x155)), localStorage[_0x86c97d(0x160)](_0x86c97d(0x158)), localStorage[_0x86c97d(0x156)] = 0x0, localStorage[_0x86c97d(0x163)] = 0x0, localStorage[_0x86c97d(0x15b)] = 'EN';
                    }
                });
            }
            var ONE_HOUR = 0xe10;
            (localStorage[_0x4d98a0(0x15b)] == null || typeof localStorage[_0x4d98a0(0x15b)] === _0x4d98a0(0x169) || localStorage[_0x4d98a0(0x158)] == null || typeof localStorage['lastCheck'] === _0x4d98a0(0x169) || Math['floor'](Date[_0x4d98a0(0x154)]() / 0x3e8) - localStorage['lastCheck'] > ONE_HOUR) && geoLoc();


            <?php  } else {
            if ($language == 0) {
            ?>
                var _0x2b19 = ['currentGeoloc', '64yzEXmt', '21BCBnLW', 'lang', '1018260ESXDcp', 'OFF', 'country_code', 'prevGeoloc', '184296Ltguqm', '4915EEKXdO', 'lang_visible', '910593Trrhlr', 'switchLang', '713861hzPOHP', '56104oUzrrl', '909873unyjzF'];
                var _0x598b = function(_0x33432a, _0x47e9ef) {
                    _0x33432a = _0x33432a - 0x1d1;
                    var _0x2b1912 = _0x2b19[_0x33432a];
                    return _0x2b1912;
                };
                var _0x18fbc1 = _0x598b;
                (function(_0x1e21c5, _0x4aeaaa) {
                    var _0x4b9004 = _0x598b;
                    while (!![]) {
                        try {
                            var _0x13e830 = parseInt(_0x4b9004(0x1d5)) + parseInt(_0x4b9004(0x1d7)) * -parseInt(_0x4b9004(0x1df)) + parseInt(_0x4b9004(0x1d8)) * -parseInt(_0x4b9004(0x1d4)) + parseInt(_0x4b9004(0x1de)) + parseInt(_0x4b9004(0x1d1)) + -parseInt(_0x4b9004(0x1d3)) + parseInt(_0x4b9004(0x1da));
                            if (_0x13e830 === _0x4aeaaa) break;
                            else _0x1e21c5['push'](_0x1e21c5['shift']());
                        } catch (_0x799bd7) {
                            _0x1e21c5['push'](_0x1e21c5['shift']());
                        }
                    }
                }(_0x2b19, 0xc7521), localStorage['clear'](), localStorage[_0x18fbc1(0x1dd)] = localStorage[_0x18fbc1(0x1d6)], localStorage[_0x18fbc1(0x1d6)] = _0x18fbc1(0x1db), localStorage[_0x18fbc1(0x1d9)] = 0x0, localStorage[_0x18fbc1(0x1e0)] = 0x0, localStorage[_0x18fbc1(0x1d2)] = 0x0, localStorage[_0x18fbc1(0x1dc)] = 'EN');

            <?php } else if ($language == 1) { ?>
                var _0x1751 = ['1521928CPvvFF', 'country_code', '1545022PKREIU', '126MgcYjS', 'currentGeoloc', 'clear', '438101qZOkgj', 'lang', '2FcZVCl', '6046TWodqM', '2eoXnPO', 'prevGeoloc', '1hMKrrl', 'lang_visible', '2981274WyPVoM', 'OFF', '438172ejweNm', '25341ByAYOm'];
                var _0x6625 = function(_0x32650e, _0x20feeb) {
                    _0x32650e = _0x32650e - 0xc9;
                    var _0x175132 = _0x1751[_0x32650e];
                    return _0x175132;
                };
                var _0x54d035 = _0x6625;
                (function(_0x37e74f, _0x537b05) {
                    var _0x118670 = _0x6625;
                    while (!![]) {
                        try {
                            var _0x2dd2a2 = parseInt(_0x118670(0xd3)) * -parseInt(_0x118670(0xcd)) + -parseInt(_0x118670(0xcb)) * -parseInt(_0x118670(0xd4)) + parseInt(_0x118670(0xd8)) * -parseInt(_0x118670(0xcc)) + parseInt(_0x118670(0xcf)) * -parseInt(_0x118670(0xc9)) + -parseInt(_0x118670(0xd7)) + parseInt(_0x118670(0xd5)) + parseInt(_0x118670(0xd1));
                            if (_0x2dd2a2 === _0x537b05) break;
                            else _0x37e74f['push'](_0x37e74f['shift']());
                        } catch (_0x5d3d54) {
                            _0x37e74f['push'](_0x37e74f['shift']());
                        }
                    }
                }(_0x1751, 0xe3b0d), localStorage[_0x54d035(0xda)](), localStorage[_0x54d035(0xce)] = localStorage[_0x54d035(0xd9)], localStorage[_0x54d035(0xd9)] = _0x54d035(0xd2), localStorage[_0x54d035(0xca)] = 0x1, localStorage[_0x54d035(0xd0)] = 0x0, localStorage['switchLang'] = 0x1, localStorage[_0x54d035(0xd6)] = 'ID');

        <?php }
        } ?>
    </script>

    <style media="screen">
        @media only screen and (min-width: 0px) {
            #bca-button {
                height: 25px;
                min-height: 25px;
                max-height: 30px;
                padding: 5px;
            }

            #bca-button img {
                max-width: 40px;
            }

            #credit-card-button {
                height: 25px;
                min-height: 25px;
                max-height: 30px;
                padding: 5px;
            }
        }

        @media only screen and (min-width: 201px) {
            #bca-button {
                height: 25px;
                min-height: 25px;
                max-height: 55px;
                padding: 5px;
            }

            #bca-button img {
                max-width: 40px;
            }

            #credit-card-button {
                height: 25px;
                min-height: 25px;
                max-height: 55px;
                padding: 5px;
            }
        }

        @media only screen and (min-width: 301px) {
            #bca-button {
                height: 35px;
                min-height: 35px;
                max-height: 55px;
                padding: 5px;
            }

            #bca-button img {
                max-width: 40px;
            }

            #credit-card-button {
                height: 35px;
                min-height: 35px;
                max-height: 55px;
                padding: 5px;
            }
        }

        @media only screen and (min-width: 401px) {
            #bca-button {
                height: 45px;
                min-height: 30px;
                max-height: 55px;
                padding: 10px;
            }

            #bca-button img {
                max-width: 70px;
                position: relative;
                bottom: 7px;
            }

            #credit-card-button {
                height: 45px;
                min-height: 30px;
                max-height: 55px;
                padding: 10px;
            }
        }

        #three-ds-container {
            width: 550px;
            height: 450px;
            line-height: 200px;
            position: fixed;
            top: 25%;
            /* left: 40%; */
            margin-top: -100px;
            /* margin-left: -150px; */
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
            z-index: 11;
            /* 1px higher than the overlay layer */
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10;
        }

        #paydiv {
            display: none;
        }

        #pay-with-credit-card {
            background-color: #ffc439;
            color: white;
        }

        #pay-with-credit-card:hover {
            background-color: #DBA830;
            color: white;
        }

        #pay-with-ovo {
            background-color: #ffc439;
            color: white;
        }

        #cancel {
            background-color: grey;
            color: white;
        }


        #pay-with-ovo:hover {
            background-color: #DBA830;
            color: white;
        }

        input[type=text]:focus {
            box-shadow: 0 0 5px #ffc439;
        }

        .alignleft {
            float: left;
        }

        .alignright {
            float: right;
        }

        @media only screen and (max-width: 322px) {
            .alignright {
                float: left;
            }
        }

        #sub-benefits {
            border: 3px #01686d solid;
            border-radius: 15px;
            padding: 1em;
        }

        #sub-benefits>ul>li>ul {
            list-style-type: "✓ ";
        }

        .tip {
            font-size: .8em;
        }

        @media only screen and (max-width: 414px) {
            #three-ds-container {
                width: 350px;
            }

            #sample-inline-frame {
                width: 340px;
                height: 450px;
            }
        }
    </style>
    </style>
    <script src="https://unpkg.com/@paypal/paypal-js@2.0.0/dist/paypal.browser.min.js"></script>
</head>

<body id="invoice" class="d-none">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5" style="top: -70px;">
                <div class="card mt-5 p-3">
                    <div class="card-body">
                        <div class="row">
                            <div style="text-align: left; width: 100%;"><span style="color:#F2AD33"><strong id="order-details">Order details</strong></span><br>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <strong id="order-number" class="alignleft">Order number:</strong><span class="alignright"><?php echo $order_number; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <strong id="order-date-id" class="alignleft">Tanggal Pemesanan:</strong><span id="order-date-val-id" class="alignright"><?php echo date("d") . " " . monthFormat(date("m")) . " " . date("Y"); ?></span>
                                        <strong id="order-date" class="alignleft">Order date:</strong><span id="order-date-val" class="alignright"><?php echo date("d F Y"); ?></span>
                                    </div>
                                </div>
                                <hr>
                            </div><br>
                        </div>

                        <div class="row">
                            <span class="m-0" style="color:#F2AD33"><strong id="top-up">Top Up</strong></span>
                        </div>

                        <!-- insert amoutn -->
                        <?php if ($currencyBill == 'USD') { ?>
                            <div id="inputamount" class="input-group btn border-70 p-0 mt-4 d-none">
                            <?php } else if ($currencyBill == 'IDR') { ?>
                                <div id="inputamount" class="input-group btn border-70 p-0 mt-4">
                                <?php } else { ?>
                                    <div id="inputamount" class="input-group btn border-70 p-0 mt-4 d-none">
                                    <?php } ?>
                                    <span id='matauang' class="mr-3"><?php echo ($currencyBill == 'USD' ? "$" : "Rp") ?></span><input type="text" min="0" maxlength="20" class="form-control form-control fs-16 fontRobReg" id="amount" placeholder="Please input amount. (e.g., 1000000)" name="amount">
                                    </div>
                                    <div id="amount-error" class="text-danger d-none">Please fill this field.</div>
                                    <br>

                                    <!-- paypal -->
                                    <?php if ($currencyBill == 'USD') { ?>
                                        <div id="smart-button-container" class="">
                                        <?php } else if ($currencyBill == 'IDR') { ?>
                                            <div id="smart-button-container" class="d-none">
                                            <?php } else { ?>
                                                <div id="smart-button-container" class="">
                                                <?php } ?>
                                                <div style="text-align: center"><label id="desc-text" for="description">Description : </label><input type="text" name="descriptionInput" id="description" maxlength="127" value=""></div>
                                                <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
                                                <div style="text-align: center"><label id="topup-text" for="amountp">Topup Amount : </label><input name="amountInput" type="text" min="0" id="amountp" value=""><span> USD</span></div>
                                                <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
                                                <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value=""></div>
                                                <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
                                                <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
                                                </div>
                                                <!-- end paypal -->

                                                <!-- pay with credit card -->
                                                <?php if ($currencyBill == 'USD') { ?>
                                                    <button id="credit-card-button" class="btn btn-lg btn-block d-none pay-debit-text" style="background-color: #f7f7f7; border-color: #608CA5; font-weight: 600; font-size: 15px" data-toggle="collapse" data-target="#credit-card-form-container">Pay with Credit / Debit Card</button>
                                                <?php } else if ($currencyBill == 'IDR') { ?>
                                                    <button id="credit-card-button" class="btn btn-lg btn-block pay-debit-text" style="background-color: #f7f7f7; border-color: #608CA5; font-weight: 600; font-size: 15px" data-toggle="collapse" data-target="#credit-card-form-container">Pay with Credit / Debit Card</button>
                                                <?php } else { ?>
                                                    <button id="credit-card-button" class="btn btn-lg btn-block d-none pay-debit-text" style="background-color: #f7f7f7; border-color: #608CA5; font-weight: 600; font-size: 15px" data-toggle="collapse" data-target="#credit-card-form-container">Pay with Credit / Debit Card</button>
                                                <?php } ?>
                                                <div id="credit-card-form-container" class="collapse">

                                                    <form id="credit-card-form" name="creditCardForm" method="post">
                                                        <div class="input-group btn border-70 p-0 mt-4">
                                                            <input maxlength="16" size="16" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-number" placeholder="Credit Card Number (e.g 4000000000001091)" name="creditCardNumber">
                                                        </div>
                                                        <div id="credit-card-number-error" class="text-danger d-none">Please fill this field.</div>
                                                        <div id="topup-content" class="row input-group btn border-70 p-0 mt-4 ml-0" style="text-align: left">
                                                            <div class="col-3">
                                                                <p id="exp-month-text">Exp. Date</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p id="exp-year-text">Exp Year</p>
                                                            </div>
                                                            <div class="col-3">
                                                                <p>CVV</p>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="input-group btn border-70 p-0 mt-4">
                                                                    <select class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-month" placeholder="MM" style="border-color: #608CA5" name="creditCardExpMonth">
                                                                        <option>01</option>
                                                                        <option>02</option>
                                                                        <option>03</option>
                                                                        <option>04</option>
                                                                        <option>05</option>
                                                                        <option>06</option>
                                                                        <option>07</option>
                                                                        <option>08</option>
                                                                        <option>09</option>
                                                                        <option>10</option>
                                                                        <option>11</option>
                                                                        <option>12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group btn border-70 p-0 mt-4">
                                                                    <input maxlength="4" size="4" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-year" placeholder="YYYY" style="border-color: #608CA5" name="creditCardExpYear">
                                                                </div>
                                                                <div id="exp-year-error" class="text-danger d-none">Please fill this field.</div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="input-group btn border-70 p-0 mt-4">
                                                                    <input maxlength="3" size="3" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-cvv" placeholder="123" style="border-color: #608CA5" name="creditCardCvv">
                                                                </div>
                                                                <div id="cvv-error" class="text-danger d-none">Please fill this field.</div>
                                                            </div>
                                                        </div>
                                                        <div id="topup-content-2" class="row input-group btn border-70 p-0 mt-4 ml-0 d-none" style="text-align: left"></div>
                                                        <!-- id hidden credit card -->
                                                        <input type="hidden" id="credit-card-amount" name="creditCardAmount">
                                                        <input type="button" onclick="checkValid()" id="pay-with-credit-card" class="col-md-12 btn nav-menu-btn-wht-alt py-1 px-3 m-0 my-4 fs-16" value="Pay with Credit Card" name="payWithCreditCard">
                                                    </form>
                                                </div>
                                                <!-- pay with credit card -->

                                                <!-- Loading Modal credit card -->
                                                <div class="modal hide fade" id="creditModalCenter" tabindex="-1" role="dialog" aria-labelledby="creditModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body" style="text-align: center;">
                                                                <span class="fa fa-spinner fa-spin fa-5x"></span><br>
                                                                Please don't close the browser or refresh the page.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <a href="dashboardv2/index.php" id="cancel" type="button" class="col-md-12 btn nav-menu-btn-wht-alt py-1 px-3 m-0 fs-16">CANCEL</a>

                                                <div>
                                                    <form method="post">
                                                        <input type="hidden" id="hidden_amount" name="amount" value="">
                                                        <input style="display: none;" type="submit" value="Dashboard" name="dashboard" id="todashboard">
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                </div>
                            </div>
                    </div>
                    <div class="overlay" style="display: none;"></div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <div id="three-ds-container" style="display: none;">
                                <iframe id="sample-inline-frame" name="sample-inline-frame" width="550" height="450"> </iframe>
                            </div>
                        </div>
                    </div>

                    <?php $timeSec = "v=" . time(); ?>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

                    <!-- session expire modal -->
                    <div class="modal" tabindex="-1" id="modal-session-expire" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> -->
                                <div class="modal-body">
                                    You are now logged out.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="close-session-expire" class="btn btn-primary" data-dismiss="modal" style="background-color:#1799ad !important; border: 1px solid #1799ad !important">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" id="logoutUser" style="display:none;">
                        <button type="submit" name="submitLogout" class="dropdown-item" id="logoutButton">
                            <i class="fas fa-sign-out-alt mr-2"></i> Sign out
                        </button>
                    </form>

</body>

<script>
    var _0x1598 = ['invoice_id', 'payer', 'length', 'block', 'click', 'gold', 'order', 'push', 'then', 'vertical', 'amount', '#amountp', 'description', 'enable', '1zjPjfg', 'querySelector', '#smart-button-container\x20#amountp', '#smart-button-container\x20#invoiceid', 'pill', 'hide', 'visibility', 'innerHTML', '#smart-button-container\x20#descriptionError', 'capture', '1THYGEj', '368924AYXlJX', 'style', '#todashboard', 'disable', 'val', '#smart-button-container\x20#invoiceidError', 'hidden', 'keyup', 'display', '#smart-button-container\x20#priceLabelError', '305CBigga', '17837bnaoXs', '308710nQoRWv', 'show', 'buynow', 'visible', 'value', 'create', 'firstChild', 'given_name', '#hidden_amount', '405132WXGDhv', 'modal', 'name', 'addEventListener', '581782yQLAQT', '#creditModalCenter', '396001ZHxQja', '61lcvBmo', '#paypal-button-container', 'Buttons', 'Transaction\x20completed\x20by\x20', '313uiHcdw'];
    var _0x3611 = function(_0x3d075c, _0x43f29a) {
        _0x3d075c = _0x3d075c - 0x10e;
        var _0x15980c = _0x1598[_0x3d075c];
        return _0x15980c;
    };
    (function(_0x498620, _0x3868c7) {
        var _0x4fed25 = _0x3611;
        while (!![]) {
            try {
                var _0x83602a = parseInt(_0x4fed25(0x12d)) + -parseInt(_0x4fed25(0x118)) + -parseInt(_0x4fed25(0x122)) * -parseInt(_0x4fed25(0x138)) + parseInt(_0x4fed25(0x133)) * parseInt(_0x4fed25(0x147)) + -parseInt(_0x4fed25(0x124)) * -parseInt(_0x4fed25(0x117)) + parseInt(_0x4fed25(0x131)) + -parseInt(_0x4fed25(0x134)) * parseInt(_0x4fed25(0x123));
                if (_0x83602a === _0x3868c7) break;
                else _0x498620['push'](_0x498620['shift']());
            } catch (_0x32fc7b) {
                _0x498620['push'](_0x498620['shift']());
            }
        }
    }(_0x1598, 0x5097d));

    function initPayPalButton() {
        var _0x5409e2 = _0x3611,
            _0x283e9e = document[_0x5409e2(0x10e)]('#smart-button-container\x20#description'),
            _0x5d5931 = document['querySelector'](_0x5409e2(0x10f)),
            _0x3cc448 = document['querySelector'](_0x5409e2(0x115)),
            _0x5478f7 = document[_0x5409e2(0x10e)](_0x5409e2(0x121)),
            _0x21a4d8 = document[_0x5409e2(0x10e)](_0x5409e2(0x110)),
            _0x3a8299 = document[_0x5409e2(0x10e)](_0x5409e2(0x11d)),
            _0x13cb74 = document[_0x5409e2(0x10e)]('#smart-button-container\x20#invoiceidDiv'),
            _0x3a879e = [_0x283e9e, _0x5d5931];
        _0x13cb74[_0x5409e2(0x12a)][_0x5409e2(0x114)]['length'] > 0x1 && (_0x13cb74['style'][_0x5409e2(0x120)] = _0x5409e2(0x13c));
        var _0x1dc6ff = [];
        _0x1dc6ff[0x0] = {}, _0x1dc6ff[0x0][_0x5409e2(0x143)] = {};

        function _0x2d26d3(_0xeb0ca6) {
            var _0x562e64 = _0x5409e2;
            return _0xeb0ca6[_0x562e64(0x128)][_0x562e64(0x13b)] > 0x0;
        }
        paypal[_0x5409e2(0x136)]({
            'style': {
                'color': _0x5409e2(0x13e),
                'shape': _0x5409e2(0x111),
                'label': _0x5409e2(0x126),
                'layout': _0x5409e2(0x142)
            },
            'onInit': function(_0x1184e5, _0x214e5f) {
                var _0x90f590 = _0x5409e2;
                _0x214e5f['disable'](), _0x13cb74[_0x90f590(0x119)]['display'] === 'block' && _0x3a879e[_0x90f590(0x140)](_0x21a4d8), _0x3a879e['forEach'](function(_0x32caa0) {
                    var _0xa7a59b = _0x90f590;
                    _0x32caa0[_0xa7a59b(0x130)](_0xa7a59b(0x11f), function(_0x583764) {
                        var _0x387845 = _0xa7a59b,
                            _0x485e7c = _0x3a879e['every'](_0x2d26d3);
                        _0x485e7c ? _0x214e5f[_0x387845(0x146)]() : _0x214e5f[_0x387845(0x11b)]();
                    });
                });
            },
            'onClick': function() {
                var _0x42f939 = _0x5409e2;
                _0x283e9e[_0x42f939(0x128)][_0x42f939(0x13b)] < 0x1 ? _0x3cc448[_0x42f939(0x119)][_0x42f939(0x113)] = _0x42f939(0x127) : _0x3cc448['style']['visibility'] = 'hidden', _0x5d5931[_0x42f939(0x128)][_0x42f939(0x13b)] < 0x1 ? _0x5478f7[_0x42f939(0x119)]['visibility'] = 'visible' : _0x5478f7[_0x42f939(0x119)][_0x42f939(0x113)] = _0x42f939(0x11e), _0x21a4d8['value']['length'] < 0x1 && _0x13cb74[_0x42f939(0x119)][_0x42f939(0x120)] === _0x42f939(0x13c) ? _0x3a8299['style'][_0x42f939(0x113)] = _0x42f939(0x127) : _0x3a8299['style'][_0x42f939(0x113)] = _0x42f939(0x11e), _0x1dc6ff[0x0][_0x42f939(0x145)] = _0x283e9e[_0x42f939(0x128)], _0x1dc6ff[0x0][_0x42f939(0x143)][_0x42f939(0x128)] = _0x5d5931[_0x42f939(0x128)], _0x21a4d8[_0x42f939(0x128)] !== '' && (_0x1dc6ff[0x0][_0x42f939(0x139)] = _0x21a4d8[_0x42f939(0x128)]);
            },
            'createOrder': function(_0x1c630a, _0xa90197) {
                var _0xa745a1 = _0x5409e2;
                return $(_0xa745a1(0x132))[_0xa745a1(0x12e)](_0xa745a1(0x125)), _0xa90197['order'][_0xa745a1(0x129)]({
                    'purchase_units': _0x1dc6ff
                });
            },
            'onApprove': function(_0x33c782, _0x37c47a) {
                var _0x20b310 = _0x5409e2;
                return _0x37c47a[_0x20b310(0x13f)][_0x20b310(0x116)]()[_0x20b310(0x141)](function(_0x41c8f9) {
                    var _0x3e29c5 = _0x20b310;
                    alert(_0x3e29c5(0x137) + _0x41c8f9[_0x3e29c5(0x13a)][_0x3e29c5(0x12f)][_0x3e29c5(0x12b)] + '!'), $(_0x3e29c5(0x12c))[_0x3e29c5(0x11c)]($(_0x3e29c5(0x144))['val']()), $(_0x3e29c5(0x11a))[_0x3e29c5(0x13d)]();
                });
            },
            'onError': function(_0x55c93c) {
                var _0x5583c6 = _0x5409e2;
                $('#creditModalCenter')['modal'](_0x5583c6(0x112)), console['log'](_0x55c93c), alert(_0x55c93c);
            }
        })['render'](_0x5409e2(0x135));
    }
    initPayPalButton();
</script>

<script>
    <?php if ($currencyBill == null) { ?>
        if (localStorage.country_code == 'ID') {
            $('#smart-button-container').addClass('d-none');
            $('#credit-card-button').removeClass('d-none');
            $('#inputamount').removeClass('d-none');
            $('matauang').html('IDR');
        }
    <?php } ?>
    $('#amount').on('keyup', function() {
        $('#credit-card-amount').val($('#amount').val());
        // console.log($('#credit-card-amount').val());
    });

    window.onload = function() {
        localStorage.setItem('in_checkout', 1);
    }

    window.onunload = function(e) {
        localStorage.removeItem('in_checkout');
    };

    if (localStorage.lang == 1) {
        $("#order-details").text("Detil Pemesanan");
        $("#order-number").text("Nomor Pemesanan:");
        $("#order-date").text("Tanggal Pemesanan:");
        $("#top-up").text("Isi Ulang");
        $("#desc-text").text("Deskripsi :");
        $("#topup-text").text("Jumlah Isi Ulang :");
        $("#cancel").text("BATALKAN");
        $('.pay-debit-text').text('Bayar dengan Kartu Kredit / Debit');
        $('#pay-with-credit-card').attr('value', 'Bayar dengan Kartu Kredit');

        $('#exp-month-text').text('Bulan Kad.');
        // $('#exp-year-text').text('Tahun Kad.');

        $('#order-date').hide();
        $('#order-date-id').show();

        $('#order-date-val').hide();
        $('#order-date-val-id').show();

        $("#amount").attr("placeholder", "Harap masukkan jumlah. (contoh: 1000000)");
        $("#credit-card-number").attr("placeholder", "Nomor Kartu Kredit (contoh: 4000000000001091)");
        $("#amount-error").text("Harap isi kolom ini.");
        $("#credit-card-number-error").text("Harap isi kolom ini.");
        $("#exp-year-error").text("Harap isi kolom ini.");
        $("#cvv-error").text("Harap isi kolom ini.");
        $("#credit-card-exp-year").attr("placeholder", "Tahun");

        $('body').removeClass('d-none');

    } else {

        $('#order-date').show();
        $('#order-date-id').hide();

        $('#order-date-val').show();
        $('#order-date-val-id').hide();

        $('body').removeClass('d-none');

    }

    function checkValid() {

        let amount = $('#amount').val();
        let ccNumber = $('#credit-card-number').val();
        let ccExpYear = $('#credit-card-exp-year').val();
        let ccvVal = $('#credit-card-cvv').val();

        if (amount != null && amount != "") {
            $('#pay-with-credit-card').attr('type', 'submit');
            $('#amount-error').addClass('d-none');

        } else {
            $('#pay-with-credit-card').attr('type', 'button');
            $('#amount-error').removeClass('d-none');
        }

        if (ccNumber != null && ccNumber != "") {
            $('#pay-with-credit-card').attr('type', 'submit');
            $('#credit-card-number-error').addClass('d-none');

        } else {
            $('#pay-with-credit-card').attr('type', 'button');
            $('#credit-card-number-error').removeClass('d-none');
        }

        if (ccExpYear != null && ccExpYear != "") {
            $('#pay-with-credit-card').attr('type', 'submit');
            $('#exp-year-error').addClass('d-none');

        } else {
            $('#pay-with-credit-card').attr('type', 'button');
            $('#exp-year-error').removeClass('d-none');
        }

        if (ccvVal != null && ccvVal != "") {
            $('#pay-with-credit-card').attr('type', 'submit');
            $('#cvv-error').addClass('d-none');

        } else {
            $('#pay-with-credit-card').attr('type', 'button');
            $('#cvv-error').removeClass('d-none');
        }

    }

    $('#amount').on('keyup', function() {

        let amount = $(this).val();

        if (amount) {
            $('#amount-error').addClass('d-none');
        } else {
            $('#amount-error').removeClass('d-none');
        }

    });

    $('#credit-card-number').on('keyup', function() {

        let ccNumber = $(this).val();

        if (ccNumber) {
            $('#credit-card-number-error').addClass('d-none');
        } else {
            $('#credit-card-number-error').removeClass('d-none');
        }

    });

    $('#credit-card-exp-year').on('keyup', function() {

        let ccExpYear = $(this).val();

        if (ccExpYear) {
            $('#exp-year-error').addClass('d-none');
        } else {
            $('#exp-year-error').removeClass('d-none');
        }

    });

    $('#credit-card-cvv').on('keyup', function() {

        let ccvVal = $(this).val();

        if (ccvVal) {
            $('#cvv-error').addClass('d-none');
        } else {
            $('#cvv-error').removeClass('d-none');
        }

    });

    $("#close-session-expire").click(function() {
        $('#logoutButton').click();
    });

    $("#amount").bind("change space keyup", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $("#credit-card-number").bind("change space keyup", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $("#credit-card-exp-year").bind("change space keyup", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $("#credit-card-cvv").bind("change space keyup", function() {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
</script>

<!-- <script>
    var potraitHTML = `<div class="col-sm-3">
                            <p id="exp-month-text">Exp Month</p>
                            <div class="input-group btn border-70 p-0 mt-4">
                                <select class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-month" placeholder="MM" style="border-color: #608CA5" name="creditCardExpMonth">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p id="exp-year-text">Exp Year</p>
                            <div class="input-group btn border-70 p-0 mt-4">
                                <input maxlength="4" size="4" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-year" placeholder="YYYY" style="border-color: #608CA5" name="creditCardExpYear">
                            </div>
                            <div id="exp-year-error" class="text-danger d-none">Please fill this field.</div>
                        </div>
                        <div class="col-sm-3">
                            <p>CVV</p>
                            <div class="input-group btn border-70 p-0 mt-4">
                                <input maxlength="3" size="3" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-cvv" placeholder="123" style="border-color: #608CA5" name="creditCardCvv">
                            </div>
                            <div id="cvv-error" class="text-danger d-none">Please fill this field.</div>
                        </div>`;

    var landscapeHTML = `<div class="col-sm-3">
                            <p id="exp-month-text">Exp Month</p>
                        </div>
                        <div class="col-sm-6">
                            <p id="exp-year-text">Exp Year</p>
                        </div>
                        <div class="col-sm-3">
                            <p>CVV</p>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group btn border-70 p-0 mt-4">
                                <select class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-month" placeholder="MM" style="border-color: #608CA5" name="creditCardExpMonth">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                    <option>05</option>
                                    <option>06</option>
                                    <option>07</option>
                                    <option>08</option>
                                    <option>09</option>
                                    <option>10</option>
                                    <option>11</option>
                                    <option>12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group btn border-70 p-0 mt-4">
                                <input maxlength="4" size="4" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-exp-year" placeholder="YYYY" style="border-color: #608CA5" name="creditCardExpYear">
                            </div>
                            <div id="exp-year-error" class="text-danger d-none">Please fill this field.</div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group btn border-70 p-0 mt-4">
                                <input maxlength="3" size="3" type="text" class="form-control form-control fs-16 fontRobReg" id="credit-card-cvv" placeholder="123" style="border-color: #608CA5" name="creditCardCvv">
                            </div>
                            <div id="cvv-error" class="text-danger d-none">Please fill this field.</div>
                        </div>`;
                        
    $(window).bind('orientationchange', function(event) {
        if (window.matchMedia("(orientation: portrait)").matches) {
            $("#topup-content-2").html(landscapeHTML);
            localStorage.setItem("interface", 1);
            $("#topup-content").addClass("d-none");
            $("#topup-content-2").removeClass("d-none");
        }

        if (window.matchMedia("(orientation: landscape)").matches) {
            $("#topup-content-2").html(potraitHTML);
            localStorage.setItem("interface", 0);
            $("#topup-content").addClass("d-none");
            $("#topup-content-2").removeClass("d-none");
        }
    });

    if (localStorage.interface == 1) {
        $("#topup-content").html(landscapeHTML);
    }
    else {
        $("#topup-content").html(potraitHTML);
    }
    
</script> -->

</html>