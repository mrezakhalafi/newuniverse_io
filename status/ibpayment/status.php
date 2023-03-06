<?php 
    include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php');

    $dbconn = getDBConnIB();

    if (isset($_GET['id'])) {
      $transaction_id = $_GET['id'];
      $query = $dbconn->prepare("SELECT * FROM TRANSFER_PAYMENT WHERE ID = ?");
      $query->bind_param("i", $transaction_id);
      $query->execute();
      $checkSts = $query->get_result()->fetch_assoc();
      $status = $checkSts['STATUS'];
      $query->close();
    } else {
        $status = 0;
    }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Thank You</title>

  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>

</head>

<body>

  <div class="jumbotron text-xs-center">
  <?php if($status == 1){ ?>
    <h1 class="display-3">Terima kasih!</h1>
    <p class="lead">Pembayaran Anda telah berhasil diproses.</p>
  <?php } else { ?>
    <h1 class="display-3">Maaf</h1>
    <p class="lead">Pembayaran Anda gagal diproses.</p>
  <?php } ?>
  <hr>
  <!-- <p>
    Ada kendala? <a href="<?php echo base_url();?>contactus.php" style="color: #f0ad4e;">Hubungi kami</a>
  </p> -->
  <p>
    Tekan Back untuk kembali
  </p>
</div>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>

  <div style="margin:60px auto;text-align:center;">
    <hr>
    <img src="indonesiabisa.png" alt="IndonesiaBisa" width="200">
    <br><br>
  </div>

</body>

</html>
