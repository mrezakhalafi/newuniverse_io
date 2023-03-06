<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php'); ?>
<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php'); ?>
<?php

$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 15;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$dbconn = getDBConn();

if (isset($_SESSION['bill_id']) && $_SESSION['bill_id'] != '') {
  $bill_id = $_SESSION['bill_id'];
  $company_id = $_SESSION['id_company'];
  $user_id = $_SESSION['id_user'];

  $query = $dbconn->prepare("SELECT bil.* FROM BILLING as bil INNER JOIN COMPANY_INFO AS com WHERE bil.COMPANY = com.COMPANY AND bil.company = ? AND bil.ID = ?");
  $query->bind_param('ii', $company_id, $bill_id);
  $query->execute();
  $bill = $query->get_result()->fetch_assoc();
  $query->close();

  $query = $dbconn->prepare("SELECT * FROM PAYMENT WHERE BILL = ? AND COMPANY = ?");
  $query->bind_param("ii", $bill_id, $company_id);
  $query->execute();
  $payment = $query->get_result()->fetch_assoc();
  $payment_method = $payment['PAYMENT_METHOD'];
  $query->close();
} else {
  header("Location:" . base_url() . "dashboardv2/billpayment.php");
}

function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,2,',','.');
	return $hasil_rupiah;
 
}

?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>newuniverse.io - Customer Engagement Made Easy</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>palio_logo_round.png">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>

  @media print
  {    
    .no-print
    {
      display: none !important;
    }
  }

  .nav-menu-btn-wht-alt {
    background-color: #1799ad;
    color: #fff;
    margin: 5px 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400 !important;
    border-radius: 10px;
  }

  .nav-menu-btn-wht-alt:hover {
    background-color: #fff;
    color: #1799ad;
    border-style: solid;
    border-color: #1799ad;
  }

  .nav-menu-btn-wht-alt-print {
    background-color: #d59d00;
    color: white !important;
    margin: 5px 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400 !important;
    border-radius: 10px;
  }

  .nav-menu-btn-wht-alt-print:hover {
    background-color: #fff;
    color: #d59d00 !important;
    border-style: solid;
    border-color: #d59d00;
  }

  </style>

</head>

<body style="padding: 20px;">
<div class="row no-print mb-3">
  <div class="col-12 col-md-8">
    <h2 id="text-billing-details">Billing Details</h2>
  </div>
  <div class="col-12 col-md-4 d-flex justify-content-end">
    <a id="text-dashboard-btn" href="<?php echo base_url(); ?>dashboardv2/billpayment.php" style="font-size: 18px !important" class="btn nav-menu-btn-wht-alt">Dashboard</a>
    <a id="text-print-billing-btn" onclick="window.print()" style="font-size: 18px !important" class="btn nav-menu-btn-wht-alt-print">Print Billing</a>
  </div>
</div>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice p-2">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <img src="https://newuniverse.io/green_newuniverse.png" alt="Newuniverse Logo" class="brand-image" style="max-width: 200px; margin-top: 20px">
            <!-- Palio.io -->
            <small class="float-right" style="font-size: 1rem"><span id="text-date">Date:</span> <span id="text-registerDate"><?php echo date('d F Y'); ?></span></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <!-- <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>Admin, Inc.</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com
          </address>
        </div> -->
        <!-- /.col -->
        <!-- <div class="col-sm-4 invoice-col">
          To
          <address>
            <strong>John Doe</strong><br>
            795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (555) 539-1037<br>
            Email: john.doe@example.com
          </address>
        </div> -->
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <br>
          <b id="text-invoice">Invoice </b>#<?php echo $bill['ORDER_NUMBER']; ?><br>
          <!-- <b>Order ID:</b> 4F3S8J<br> -->
          <b id="text-payment-due">Payment Due:</b> <span class="date-payment-due"><?php echo date("d F Y", strtotime($bill['DUE_DATE'])); ?></span><br>
          <br>
          <!-- <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <!-- <th>Qty</th> -->
                <th id="text-items">Items</th>
                <!-- <th>Serial #</th> -->
                <!-- <th>Description</th> -->
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <strong id="text-nexilis-package">Nexilis Package</strong>, <span id="text-which-includes">which includes</span>:
                  <ul>
                    <li>
                      <span id="text-costumer-engagement-features">Customer Engagement features on your app</span>
                      <ul>
                        <li id="text-mobile-cc">
                          Mobile Contact Centers,
                        </li>
                        <li id="text-push-notifications">
                          Push Notifications,
                        </li>
                        <li id="text-inapp-messaging">
                          In-app Messaging,
                        </li>
                        <li id="text-live-video-streaming">
                          Live Video Streaming,
                        </li>
                        <li id="text-video-voip-calls">
                          Video and VoIP Calls
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span id="text-costumer-engagement-credit">Customer Engagement Credit that you can use for</span>
                      <ul>
                        <li>
                          <span id="text-text-recipients">Up to 5,000,000 Monthly Text Recipients</span> <sup>(1)</sup>
                        </li>
                        <li>
                          <span id="text-image-recipients">Up to 50,000 Monthly Image Recipients</span> <sup>(2)</sup>
                        </li>
                        <li>
                          <span id="text-video-recipients">Up to 5,000 Monthly Video Recipients</span> <sup>(3)</sup>
                        </li>
                        <li>
                          <span id="text-livestream-recipients">Up to 3,000 Monthly Minutes Livestream Recipients</span> <sup>(4)</sup>
                        </li>
                        <li>
                          <span id="text-voip-calls">Up to 50,000 Monthly Minutes 1-1 VoIP Calls</span> <sup>(5)</sup>
                        </li>
                        <li>
                          <span id="text-video-calls">Up to 500 Monthly Minutes 1-1 Video Calls</span> <sup>(6)</sup>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <span id="text-cs-catchup">Customer Support via Live Chat on catchUp</span>
                    </li>
                  </ul>
                </td>
                <td>
                  <?php if ($bill['CURRENCY'] == 'IDR'): ?>
                    <?php echo $bill['CURRENCY'] . " " . rupiah($bill['CHARGE']) ?>
                  <?php else: ?>
                    <?php echo $bill['CURRENCY'] . " " . $bill['CHARGE'] ?>
                  <?php endif; ?>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-12 col-md-6 mt-3 mb-3">
          <p id="text-payment-methods" class="lead">Payment Methods:</p>

          <?php
          if ($payment_method == 'Credit Card / Debit Card') {
            echo '<img src="../../dist/img/credit/cards.png" style="width: 70px" alt="Credit Card / Debit Card"><br>';
            echo '<span id="text-credit-card">( Credit Card / Debit Card )</span>';
          } elseif ($payment_method == 'OVO E-Wallet') {
            echo '<img src="../../dist/img/credit/ovo.png" style="width: 70px" alt="OVO E-Wallet"><br>';
            echo ('( OVO E-Wallet )');
          } elseif ($payment_method == 'PAYPAL') {
            echo '<img src="../../dist/img/credit/paypal.png" style="width: 70px" alt="Paypal"><br>';
            echo ('( PAYPAL )');
          }
          ?>
        </div>
        <!-- /.col -->
        <div class="col-12 col-md-6 mt-3 mb-3">
          <p class="lead" style="font-size: 1rem; font-weight: normal"><span id="text-amount-due">Amount Due:</span> <span class="date-payment-due"><?php echo date("d F Y", strtotime($bill['DUE_DATE'])); ?></span></p>

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>
                  <?php if ($bill['CURRENCY'] == 'IDR'): ?>
                    <?php echo $bill['CURRENCY'] . " " . rupiah($bill['CHARGE']); ?>
                  <?php else: ?>
                    <?php echo $bill['CURRENCY'] . " " . $bill['CHARGE']; ?>
                  <?php endif; ?>
                </td>
              </tr>
              <!-- <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr> -->
              <tr>
                <th>Total:</th>
                <?php if ($bill['CURRENCY'] == 'IDR'): ?>
                  <td><strong><?php echo $bill['CURRENCY'] . " " . rupiah($bill['CHARGE']); ?></strong></td>
                <?php else: ?>
                  <td><strong><?php echo $bill['CURRENCY'] . " " . $bill['CHARGE']; ?></strong></td>
                <?php endif; ?>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12 col-md-10">
          <ol id="hint-list" style="font-size:12px; padding-left: .8em;">
            <li id="text-1000-chars">
              Up to 1,000 chars for each text. For each text sent, the credit will be deducted by the number of recipients of the message. For example, you can send 5,000 texts to 1,000 recipients.
            </li>
            <li id="text-250-kb">
              Up to 250 KB for each image. For each image sent, the credit will be deducted by the number of recipients of the image; For example, you can send 50 images to 1,000 recipients.
            </li>
            <li id="text-25-mb">
              Up to 2.5 MB for each video. For each video sent, the credit will be deducted by the number of recipients of the image; For example, you can send 5 videos to 1,000 recipients.
            </li>
            <li id="text-3-minutes">
              Up to 3 minutes livestream to 1,000 recipients.
            </li>
            <li id="text-5000-minutes">
              If you, for example, have 10 team members, they can have 5,000 (50,000/10) minutes of VoIP Calls between them.
            </li>
            <li id="text-50-minutes">
              If you, for example, have 10 team members, they can have 50 (500/10) minutes of Video Calls between them.
            </li>
          </ol>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->

  <script src="jquery.min.js"></script>
  <script type="text/javascript">
    // window.addEventListener("load", window.print());
  </script>

  <script>
    if (localStorage.lang == 1) {
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

      var currDate = '<?php echo dateIndo(date('Y-m-d')); ?>';
      var dueDate = '<?php echo dateIndo(date('Y-m-d', strtotime($bill['DUE_DATE']))); ?>';

      $("#text-billing-details").text("Detail Tagihan");
      $("#text-dashboard-btn").text("Dasbor");
      $("#text-print-billing-btn").text("Cetak Tagihan");
      $("#text-invoice").text("Tagihan ");
      $("#text-date").text("Tanggal:");
      $("#text-payment-due").text("Jatuh Tempo ");
      $("#text-items").text("Barang");
      $("#text-nexilis-package").text("Paket Nexilis");
      $("#text-which-includes").text("yang mencakup");
      $("#text-nexilis-package").text("Paket Nexilis");
      $("#text-which-includes").text("yang mencakup");
      $("#text-costumer-engagement-features").text("Fitur Keterikatan Pelanggan di aplikasi anda");
      $("#text-mobile-cc").text("Pusat Kontak Seluler,");
      $("#text-push-notifications").text("Menambahkan Pemberitahuan,");
      $("#text-inapp-messaging").text("Pesan Dalam Aplikasi,");
      $("#text-live-video-streaming").text("Siaran Video Langsung,");
      $("#text-video-voip-calls").text("Panggilan Video dan VoIP");
      $("#text-costumer-engagement-credit").text("Kredit Keterikatan Pelanggan yang dapat anda gunakan untuk");
      $("#text-text-recipients").text("Hingga 5,000,000 Penerimaan Pesan Bulanan");
      $("#text-image-recipients").text("Hingga 50,000 Penerimaan Gambar Bulanan");
      $("#text-video-recipients").text("Hingga 5,000 Penerimaan Video Bulanan");
      $("#text-livestream-recipients").text("Hingga 3,000 Penerimaan Siaran Langsung Menitan Bulanan");
      $("#text-voip-calls").text("Hingga 50,000 Panggilan VoIP 1-1 Menit Bulanan");
      $("#text-video-calls").text("Hingga 500 Panggilan Video 1-1 Menit Bulanan");
      $("#text-cs-catchup").text("Bantuan Pelanggan melalui Pesan Langsung pada catchUp")
      $("#text-payment-methods").text("Metode Pembayaran:");
      $("#text-credit-card").text("( Kartu Kredit / Kartu Debit )");
      $("#text-amount-due").text("Jatuh Tempo:");
      $("#text-1000-chars").text("Hingga 1,000 karakter untuk setiap pesan. Untuk setiap pesan yang terkirim, kredit akan dikurangi sejumlah penerimaan pesan. Sebagai contoh, anda dapat mengirim 5,000 pesan ke 1,000 orang.");
      $("#text-250-kb").text("Hingga 250 KB untuk setiap gambar. Untuk setiap gambar yang terkirim, kredit akan dikurangi sejumlah penerimaan gambar. Sebagai contoh, anda dapat mengirim 50 gambar ke 1,000 orang.");
      $("#text-25-mb").text("Hingga 2,5 MB untuk setiap video. Untuk setiap video yang terkirim, kredit akan dikurangi sejumlah penerimaan gambar. Sebagai contoh, anda dapat mengirim 5 video ke 1,000 orang.");
      $("#text-3-minutes").text("Hingga 3 menit siaran langsung kepada 1,000 orang.");
      $("#text-5000-minutes").text("Jika anda, sebagai contoh, mempunyai 10 anggota tim, mereka dapat mempunyai 5,000 (50,000/10) menit Panggilan VoIP diantara anggota tim.");
      $("#text-50-minutes").text("Jika anda, sebagai contoh, mempunyai 10 anggota tim, mereka dapat mempunyai 50 (500/10) menit Panggilan Video diantara anggota tim.");
      $("#text-registerDate").text(currDate);
      $(".date-payment-due").text(dueDate);
    }
  </script>

</body>

</html>