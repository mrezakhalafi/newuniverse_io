<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_header.php'); ?>
<?php

// state control
$_SESSION['previous_page'] = $_SESSION['current_page'];
$_SESSION['current_page'] = 14;
require_once($_SERVER['DOCUMENT_ROOT'] . '/state_control.php');

$id_company = getSession('id_company');

$message = $dbconn->prepare("SELECT * FROM MESSAGE WHERE COMPANY = ? order by ID DESC");
$message->bind_param("i", $id_company);
$message->execute();
$itemMessage = $message->get_result();

$welcome = "Welcome to newuniverse.io!";
$payment = "Payment Notice";
$due_date = "Due Date Reminder";
$overdue = "Overdue Notice";
$cutoff_date = "Cut Off Date Reminder";
$terminate = "Service Termination Notice";
$subscribe = "Subscription Activation";

//welcome
$message1 = "Hey there, <br>
			Welcome!<br><br>
			newuniverse.io helps companies to embed Contact Center,

			Livestreaming, Push Notifications, Instant Messaging, Video and VoIP Calling Features <br> into their mobile apps so that they could stay connected with their applications users.<br>
			<br>
			Here are some resources to help get you started: <a href='/guide/index?from=2'>Quickstart guides</a>
			<br>
			We can’t wait to see what you've build!
			<br>
			<br>
			Thank you.<br>
			With Regards<br>
			newuniverse.io<br>
			";

//due date reminder
$message6 = "Dear User...
		Due Date Reminder:
		To continue using our services, you have to make a repayment on .

		Thank you.
		With Regards
		newuniverse.io<br>
		";

//overdue notice
$message3 = "Dear User...
		Overdue Reminder:
		Your package has entered a grace period, make sure to finish your payment to continue using our services.

		Thank you.
		With Regards
		newuniverse.io
		";

//cut off date reminder
$message4 = "Dear User...
		Cut Off Date Reminder:
		Your package has entered a grace period, and will be terminated on .

		Thank you.
		With Regards
		newuniverse.io<br>
		";

//termination notice
$message5 = "Dear User...
		Your package has been terminated on .

		If you are interested in using our services again,

		Thank you.
		With Regards
		newuniverse.io<br>
		";

//payment notice
$message2 = "Dear User...
		You haven't paid for your package, if you are interested in using our services please finish your payment.

		Thank you.
		With Regards
		newuniverse.io<br>
		";

// subscribe active
$message11 = "Dear User,

Thank you for activating your subscription to newuniverse.io!<br><br>
Currently, you have access to all of our API services and we hope that you will be enjoying our best services. Just as a reminder, to avoid any inconveniences please remember to always pay your subscription on time. Best of Luck.
<br>
<br>
Thank you.<br>
With Regards<br>
newuniverse.io<br>";

$nextMessage34 = ". Make sure to finish your payment to continue using our services.<br>
		<br>If you have already paid your dues, please ignore this message.
		<br>
		Thank you.<br>
		With Regards<br>
		newuniverse.io<br>";

$nextMessage5 = "  <br>
		Currently, you have access to all of our API services and we hope that you will be enjoying our best services. To avoid any inconveniences please pay your service bill on the due date in the future. Best of Luck.
		<br>
		<br>
		Thank you.<br>
		With Regards<br>
		newuniverse.io<br>
		";
?>

<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

<style>
  body {
    font-family: 'Poppins', sans-serif;
  }

  html,
  body {
    max-width: 100%;
    overflow-x: hidden;
  }
</style>

<div class="content-wrapper" id="mailbox">
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4 class="card-name"><strong id="mailbox-text">Mailbox</strong></h4>
          <div class="card" id="inbox">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12 col-lg-6 align-self-center">
                  <span style="margin: 0; font-size:1.5rem; font-weight:500;"><strong id="inbox-text">Inbox</strong></span>
                  <button class="btn pull-right" id="search-mbl" data-toggle="modal" data-target="#searchModal">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
                <div class="col-md-6">
                  <input class="form-control pull-right" id="search-msg" type="text" placeholder="Search messages by subject..." style="max-width: 400px;" />
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php $number = 0;
                    foreach ($itemMessage as $im) { ?>
                      <tr class="msgs" data-href='read-mail.php?id=<?php echo $im['ID'] ?>'>
                        <td></td>
                        <td><?php echo ++$number; ?></td>
                        <td class="mailbox-name">newuniverse.io Team</td>
                        <td class="mailbox-subject mail-title">
                          <span id="msg-title-<?= $im['ID'] ?>"><?php
                                                                if ($im['M_ID'] == 1) echo $welcome;
                                                                else if ($im['M_ID'] == 11) echo $subscribe;
                                                                else if ($im['M_ID'] == 6) echo $due_date;
                                                                else if ($im['M_ID'] == 2) echo $payment;
                                                                else if ($im['M_ID'] == 3) echo $overdue; //substr($message3, 0, 12)."...[TRIAL]";
                                                                else if ($im['M_ID'] == 4) echo $cutoff_date; //substr($message4, 0, 12)."...[DUE DATE]";
                                                                else if ($im['M_ID'] == 5) echo $terminate; //substr($message5, 0, 12)."...[PAYMENT]";
                                                                ?></span>
                        </td>
                        <td class="mailbox-subject">
                          <?php if ($im['IS_READ'] != 1) {
                            echo "<b id='msg-subject-" . $im['ID'] . "'>";
                          } else {
                            echo "<span id='msg-subject-" . $im['ID'] . "'>";
                          } ?>
                          <?php
                          if ($im['M_ID'] == 1) echo (substr($message1, 0, 100) . "...");
                          else if ($im['M_ID'] == 11) echo (substr($message11, 0, 100) . "...");
                          else if ($im['M_ID'] == 2) echo (substr($message2, 0, 100) . "...");
                          else if ($im['M_ID'] == 3) echo (substr($message3, 0, 100) . "...");
                          else if ($im['M_ID'] == 4) echo (substr($message4, 0, 100) . "...");
                          else if ($im['M_ID'] == 5) echo (substr($message5, 0, 50) . "...");
                          else if ($im['M_ID'] == 6) echo (substr($message6, 0, 100) . "...");
                          ?>
                          <?php if ($im['IS_READ'] != 1) {
                            echo "</b>";
                          } else {
                            echo "</span>";
                          } ?>
                        </td>
                        <td class="mailbox-date">
                          <span id="msg-<?= $im['ID'] ?>"><?php
                                                          // echo $im['MESSAGE_DATE']; 
                                                          $dateNtime = $im['MESSAGE_DATE'];
                                                          $newDate = date("d F Y H:i", strtotime($dateNtime));
                                                          echo $newDate;
                                                          ?></span>
                          <?php if ($im['IS_READ'] != 1) {
                            echo "<span style='color: red;''>*</span>";
                          } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/dashboardv2/dashboard_footer.php'); ?>

<script>
  var _0x49f8 = ['removeClass', 'location', '258101fRdRIy', '.msgs', 'addClass', 'a.nav-link[href=\x22support.php\x22]', '326055TAjupb', 'a.nav-link[href=\x22usage.php\x22]', 'a.nav-link[href=\x22mailbox.php\x22]', '729119JSSAZv', 'text', '^(?=.*\x5cb', 'split', 'active', ').*$', 'a.nav-link[href=\x22index.php\x22]', '353351OEMgjI', 'replace', '5mvnzuz', 'a.nav-link[href=\x22billpayment.php\x22]', '863614NteqFV', 'show', 'join', 'val', '10681jrqyuz', 'keyup', 'hide', 'trim', '1007293kgMgxR', 'test', 'data', '#search-msg', 'filter'];
  var _0x43b2 = function(_0x1ef7e4, _0x19351c) {
    _0x1ef7e4 = _0x1ef7e4 - 0x1ef;
    var _0x49f8e1 = _0x49f8[_0x1ef7e4];
    return _0x49f8e1;
  };
  var _0x2a89aa = _0x43b2;
  (function(_0x3a031e, _0x175397) {
    var _0x521c72 = _0x43b2;
    while (!![]) {
      try {
        var _0x44abf0 = parseInt(_0x521c72(0x206)) + -parseInt(_0x521c72(0x1f4)) + -parseInt(_0x521c72(0x1f0)) * -parseInt(_0x521c72(0x200)) + -parseInt(_0x521c72(0x202)) + parseInt(_0x521c72(0x20a)) + parseInt(_0x521c72(0x1fe)) + -parseInt(_0x521c72(0x1f7));
        if (_0x44abf0 === _0x175397) break;
        else _0x3a031e['push'](_0x3a031e['shift']());
      } catch (_0x4fb5c0) {
        _0x3a031e['push'](_0x3a031e['shift']());
      }
    }
  }(_0x49f8, 0xb5682), $(_0x2a89aa(0x1f1))['click'](function() {
    var _0x2a13a6 = _0x2a89aa;
    window[_0x2a13a6(0x1ef)] = $(this)[_0x2a13a6(0x20c)]('href');
  }), $(_0x2a89aa(0x201))[_0x2a89aa(0x20f)](_0x2a89aa(0x1fb)), $(_0x2a89aa(0x1fd))[_0x2a89aa(0x20f)](_0x2a89aa(0x1fb)), $(_0x2a89aa(0x1f5))['removeClass']('active'), $(_0x2a89aa(0x1f3))[_0x2a89aa(0x20f)]('active'), $(_0x2a89aa(0x1f6))[_0x2a89aa(0x1f2)](_0x2a89aa(0x1fb)));
  var $rows = $(_0x2a89aa(0x1f1));
  $(_0x2a89aa(0x20d))[_0x2a89aa(0x207)](function() {
    var _0x4e7159 = _0x2a89aa,
      _0x2efe5f = _0x4e7159(0x1f9) + $[_0x4e7159(0x209)]($(this)[_0x4e7159(0x205)]())[_0x4e7159(0x1fa)](/\s+/)[_0x4e7159(0x204)]('\x5cb)(?=.*\x5cb') + _0x4e7159(0x1fc),
      _0x3497a1 = RegExp(_0x2efe5f, 'i'),
      _0x522331;
    $rows[_0x4e7159(0x203)]()[_0x4e7159(0x20e)](function() {
      var _0x7f2b9a = _0x4e7159;
      return _0x522331 = $(this)[_0x7f2b9a(0x1f8)]()[_0x7f2b9a(0x1ff)](/\s+/g, '\x20'), !_0x3497a1[_0x7f2b9a(0x20b)](_0x522331);
    })[_0x4e7159(0x208)]();
  });
</script>

<script>
  // $('#lang-nav').hover(function(){  
  //   $('#lang-menu').dropdown("show");
  //   }, function(){
  //   $('#lang-menu').dropdown("hide");
  // });

  // $('#lang-menu').hover(function(){
  //   $('#lang-menu').dropdown("show");
  //   }, function(){
  //   $('#lang-menu').dropdown("hide");
  // });

  $(document).ready(function() {

    if (localStorage.lang == 1) {

      <?php
      function indonesiaDate($tanggal)
      {
        $bulan = array(
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
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
      }
      ?>

      <?php
      foreach ($itemMessage as $im) {
      ?>
        var mailID = '<?= $im['ID'] ?>';
        var indonesiaDate = '<?php echo indonesiaDate(date('Y H:i -m-d', strtotime($im['MESSAGE_DATE']))); ?>';
        $("#msg-" + mailID).text(indonesiaDate);
        <?php

        if ($im['M_ID'] == 1) {
        ?>
          var message1_ID = `Halo, <br>
          Selamat Datang!<br><br>
          newuniverse.io membantu perusahaan untuk menanamkan Fitur <i>Contact Center</i>,

          <i>Livestreaming</i>, <i>Push Notifications</i>, <i>Instant Messaging</i>, <i>Video</i> dan <i>VoIP Calling</i> <br> ke dalam aplikasi seluler agar mereka dapat tetap terhubung dengan pengguna aplikasi mereka.<br>
          <br>
          Berikut adalah berbagai sumber untuk membantu anda memulai menggunakan aplikasi: <a href='/guide/index?from=2'>panduan Memulai Cepat</a>
          <br>
          Kami tidak dapat menunggu untuk melihat apa yang telah anda bangun!
          <br>
          <br>
          Terima kasih.<br>
          Dengan Hormat<br>
          newuniverse.io<br>`;
          var message1_title_ID = "Selamat Datang di newuniverse.io!";
          $("#msg-subject-<?= $im['ID'] ?>").html(message1_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message1_title_ID);
        <?php
        } else if ($im['M_ID'] == 2) {
        ?>
          var message2_ID = `Untuk Pengguna...
          Anda belum membayar untuk paket anda, jika anda tertarik untuk menggunakan layanan kami mohon selesaikan pembayaran anda.

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message2_title_ID = "Melihat Pembayaran";
          $("#msg-subject-<?= $im['ID'] ?>").html(message2_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message2_title_ID);
        <?php
        } else if ($im['M_ID'] == 3) {
        ?>
          var message3_ID = `Untuk Pengguna...
          Pengingat Keterlambatan:
          Paket anda telah memasuki masa tenggang, harap pastikan untuk menyelesaikan pembayaran anda untuk melanjutkan menggunakan layanan kami.

          Terima kasih.
          Dengan Hormat
          newuniverse.io`;
          var message3_title_ID = "Melihat Keterlambatan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message3_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message3_title_ID);
        <?php
        } else if ($im['M_ID'] == 4) {
        ?>
          var message4_ID = `Untuk Pengguna...
          Pengingat Tanggal Pemotongan:
          Paket anda telah memasuki masa tenggang, dan akan berakhir .

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message4_title_ID = "Pengingat Tanggal Pemotongan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message4_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message4_title_ID);
        <?php
        } else if ($im['M_ID'] == 5) {
        ?>
          var message5_ID = `Untuk Pengguna...
          Paket anda telah berakhir .

          Jika anda tertarik untuk menggunakan layanan kami lagi,

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message5_title_ID = "Melihat Pemutusan Layanan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message5_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message5_title_ID);
        <?php
        } else if ($im['M_ID'] == 6) {
        ?>
          var message6_ID = `Untuk Pengguna...
          Pengingat Tanggal Jatuh Tempo:
          Untuk melanjutkan menggunakan layanan kami, anda harus melakukan pembayaran kembali .

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message6_title_ID = "Pengingat Tanggal Jatuh Tempo";
          $("#msg-subject-<?= $im['ID'] ?>").html(message6_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message6_title_ID);
        <?php
        } else if ($im['M_ID'] == 11) {
        ?>
          var message11_ID = `Untuk Pengguna,

          Terima kasih telah melakukan aktivasi langganan newuniverse.io anda! <br><br>
          Saat ini, anda mempunyai akses ke semua layanan <i>API</i> kami dan kami harap anda akan menikmati layanan terbaik kami. Sebagai pengingat, untuk menghindari segala bentuk ketidaknyamanan mohon ingat untuk selalu membayar langganan anda tepat waktu. Semoga Beruntung.
          <br>
          <br>
          Terima kasih.<br>
          Dengan Hormat<br>
          newuniverse.io<br>`;
          var message11_title_ID = "Aktivasi Langganan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message11_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message11_title_ID);
      <?php
        }
      }
      ?>

      $('#mailbox-text').text("Kotak Surat");
      $('#inbox-text').text("Pesan Masuk");
      $('#search-msg').attr('placeholder', 'Cari pesan dengan awalan subjek...');
      $(".mailbox-name").text("Tim newuniverse.io");
    }

    $("#change-lang-EN").click(function() {
      localStorage.lang = 0;

      <?php
      foreach ($itemMessage as $im) {
      ?>
        var mailID = '<?= $im['ID'] ?>';
        var englishDate = '<?= date("d F Y H:i", strtotime($im['MESSAGE_DATE'])); ?>';
        $("#msg-" + mailID).text(englishDate);
        <?php

        if ($im['M_ID'] == 1) {
        ?>
          var message1_EN = `Hey there, <br>
          Welcome!<br><br>
          newuniverse.io helps companies to embed Contact Center,

          Livestreaming, Push Notifications, Instant Messaging, Video and VoIP Calling Features <br> into their mobile apps so that they could stay connected with their applications users.<br>
          <br>
          Here are some resources to help get you started: <a href='/guide/index?from=2'>Quickstart guides</a>
          <br>
          We can’t wait to see what you've build!
          <br>
          <br>
          Thank you.<br>
          With Regards<br>
          newuniverse.io<br>`;
          var message1_title_EN = "Welcome to newuniverse.io!";
          $("#msg-subject-<?= $im['ID'] ?>").html(message1_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message1_title_EN);
        <?php
        } else if ($im['M_ID'] == 2) {
        ?>
          var message2_EN = `Dear User...
          You haven't paid for your package, if you are interested in using our services please finish your payment.

          Thank you.
          With Regards
          newuniverse.io<br>`;
          var message2_title_EN = "Payment Notice";
          $("#msg-subject-<?= $im['ID'] ?>").html(message2_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message2_title_EN);
        <?php
        } else if ($im['M_ID'] == 3) {
        ?>
          var message3_EN = `Dear User...
          Overdue Reminder:
          Your package has entered a grace period, make sure to finish your payment to continue using our services.

          Thank you.
          With Regards
          newuniverse.io`;
          var message3_title_EN = "Overdue Notice";
          $("#msg-subject-<?= $im['ID'] ?>").html(message3_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message3_title_EN);
        <?php
        } else if ($im['M_ID'] == 4) {
        ?>
          var message4_EN = `Dear User...
          Cut Off Date Reminder:
          Your package has entered a grace period, and will be terminated on .

          Thank you.
          With Regards
          newuniverse.io<br>`;
          var message4_title_EN = "Cut Off Date Reminder";
          $("#msg-subject-<?= $im['ID'] ?>").html(message4_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message4_title_EN);
        <?php
        } else if ($im['M_ID'] == 5) {
        ?>
          var message5_EN = `Dear User...
          Your package has been terminated on .

          If you are interested in using our services again,

          Thank you.
          With Regards
          newuniverse.io<br>`;
          var message5_title_EN = "Service Termination Notice";
          $("#msg-subject-<?= $im['ID'] ?>").html(message5_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message5_title_EN);
        <?php
        } else if ($im['M_ID'] == 6) {
        ?>
          var message6_EN = `Dear User...
          Due Date Reminder:
          To continue using our services, you have to make a repayment on .

          Thank you.
          With Regards
          newuniverse.io<br>`;
          var message6_title_EN = "Due Date Reminder";
          $("#msg-subject-<?= $im['ID'] ?>").html(message6_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message6_title_EN);
        <?php
        } else if ($im['M_ID'] == 11) {
        ?>
          var message11_EN = `Dear User,

          Thank you for activating your subscription to newuniverse.io!<br><br>
          Currently, you have access to all of our API services and we hope that you will be enjoying our best services. Just as a reminder, to avoid any inconveniences please remember to always pay your subscription on time. Best of Luck.
          <br>
          <br>
          Thank you.<br>
          With Regards<br>
          newuniverse.io<br>`;
          var message11_title_EN = "Subscription Activation";
          $("#msg-subject-<?= $im['ID'] ?>").html(message11_EN.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message11_title_EN);
      <?php
        }
      }
      ?>

      $("#lang-nav").text('EN');
      $('#mailbox-text').text("Mailbox");
      $('#inbox-text').text("Inbox");
      $('#search-msg').attr('placeholder', 'Search messages by subject...');
      $(".mailbox-name").text("newuniverse.io Team");
      change_lang();
    });

    $("#change-lang-ID").click(function() {
      localStorage.lang = 1;
      console.log(localStorage.lang);
      <?php
      function dateIndonesia($tanggal)
      {
        $bulan = array(
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
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
      }
      ?>

      <?php
      foreach ($itemMessage as $im) {
      ?>
        var mailID = '<?= $im['ID'] ?>';
        var indonesiaDate = '<?php echo dateIndonesia(date('Y H:i -m-d', strtotime($im['MESSAGE_DATE']))); ?>';
        $("#msg-" + mailID).text(indonesiaDate);
        <?php

        if ($im['M_ID'] == 1) {
        ?>
          var message1_ID = `Halo, <br>
          Selamat Datang!<br><br>
          newuniverse.io membantu perusahaan untuk menanamkan Fitur <i>Contact Center</i>,

          <i>Livestreaming</i>, <i>Push Notifications</i>, <i>Instant Messaging</i>, <i>Video</i> dan <i>VoIP Calling</i> <br> ke dalam aplikasi seluler agar mereka dapat tetap terhubung dengan pengguna aplikasi mereka.<br>
          <br>
          Berikut adalah berbagai sumber untuk membantu anda memulai menggunakan aplikasi: <a href='/guide/index?from=2'>panduan Memulai Cepat</a>
          <br>
          Kami tidak dapat menunggu untuk melihat apa yang telah anda bangun!
          <br>
          <br>
          Terima kasih.<br>
          Dengan Hormat<br>
          newuniverse.io<br>`;
          var message1_title_ID = "Selamat Datang di newuniverse.io!";
          $("#msg-subject-<?= $im['ID'] ?>").html(message1_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message1_title_ID);
        <?php
        } else if ($im['M_ID'] == 2) {
        ?>
          var message2_ID = `Untuk Pengguna...
          Anda belum membayar untuk paket anda, jika anda tertarik untuk menggunakan layanan kami mohon selesaikan pembayaran anda.

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message2_title_ID = "Melihat Pembayaran";
          $("#msg-subject-<?= $im['ID'] ?>").html(message2_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message2_title_ID);
        <?php
        } else if ($im['M_ID'] == 3) {
        ?>
          var message3_ID = `Untuk Pengguna...
          Pengingat Keterlambatan:
          Paket anda telah memasuki masa tenggang, harap pastikan untuk menyelesaikan pembayaran anda untuk melanjutkan menggunakan layanan kami.

          Terima kasih.
          Dengan Hormat
          newuniverse.io`;
          var message3_title_ID = "Melihat Keterlambatan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message3_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message3_title_ID);
        <?php
        } else if ($im['M_ID'] == 4) {
        ?>
          var message4_ID = `Untuk Pengguna...
          Pengingat Tanggal Pemotongan:
          Paket anda telah memasuki masa tenggang, dan akan berakhir .

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message4_title_ID = "Pengingat Tanggal Pemotongan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message4_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message4_title_ID);
        <?php
        } else if ($im['M_ID'] == 5) {
        ?>
          var message5_ID = `Untuk Pengguna...
          Paket anda telah berakhir .

          Jika anda tertarik untuk menggunakan layanan kami lagi,

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message5_title_ID = "Melihat Pemutusan Layanan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message5_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message5_title_ID);
        <?php
        } else if ($im['M_ID'] == 6) {
        ?>
          var message6_ID = `Untuk Pengguna...
          Pengingat Tanggal Jatuh Tempo:
          Untuk melanjutkan menggunakan layanan kami, anda harus melakukan pembayaran kembali .

          Terima kasih.
          Dengan Hormat
          newuniverse.io<br>`;
          var message6_title_ID = "Pengingat Tanggal Jatuh Tempo";
          $("#msg-subject-<?= $im['ID'] ?>").html(message6_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message6_title_ID);
        <?php
        } else if ($im['M_ID'] == 11) {
        ?>
          var message11_ID = `Untuk Pengguna,

          Terima kasih telah melakukan aktivasi langganan newuniverse.io anda! <br><br>
          Saat ini, anda mempunyai akses ke semua layanan <i>API</i> kami dan kami harap anda akan menikmati layanan terbaik kami. Sebagai pengingat, untuk menghindari segala bentuk ketidaknyamanan mohon ingat untuk selalu membayar langganan anda tepat waktu. Semoga Beruntung.
          <br>
          <br>
          Terima kasih.<br>
          Dengan Hormat<br>
          newuniverse.io<br>`;
          var message11_title_ID = "Aktivasi Langganan";
          $("#msg-subject-<?= $im['ID'] ?>").html(message11_ID.substr(0, 100) + "...");
          $("#msg-title-<?= $im['ID'] ?>").text(message11_title_ID);
      <?php
        }
      }
      ?>


      $("#lang-nav").text('ID');
      $('#mailbox-text').text("Kotak Surat");
      $('#inbox-text').text("Pesan Masuk");
      $('#search-msg').attr('placeholder', 'Cari pesan dengan awalan subjek...');
      $(".mailbox-name").text("Tim newuniverse.io");
      change_lang();
    });

  });
</script>