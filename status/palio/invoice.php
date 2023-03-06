  <?php

  include_once($_SERVER['DOCUMENT_ROOT'] . '/url_function.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php');
  // require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt.php');
  // require_once($_SERVER['DOCUMENT_ROOT'] . '/header-alt-meta.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . '/session_function.php');

  if (!isset($_SESSION['id_company']) || $_SESSION['id_company'] == null) {
    redirect (base_url() . 'login.php');
  }

  $dbconn = getDBConn();

  $company_id = $_SESSION['id_company'];
  // $company_id = 29;
  $query = $dbconn->prepare("SELECT * FROM SUBSCRIPTION_TYPE WHERE COMPANY_ID = ?");
  $query->bind_param("i", $company_id);
  $query->execute();
  $subscriptionData = $query->get_result()->fetch_assoc();
  $ordernumber = $subscriptionData['ID'];
  $orderdate = $subscriptionData['DATE'];
  $order_type = $subscriptionData['TYPE'];
  $price = $subscriptionData['PRICE'];
  $query->close();

  if ($order_type == 'monthly') {
    $pay_when = 'Monthly Recurring Payment';
  } else {
    $pay_when = 'One Month Only';
  }

  ?>

  <style>
    ol#hint-list {
      counter-reset: item;
      list-style: none;
      list-style-position: outside;
    }

    ol#hint-list li::before {
      content: "(" counter(item) ") ";
      counter-increment: item;
    }

    ol#hint-list li{
      list-style-position: inside;
      text-indent: -1em;
      padding-left: 1em;
    }
  </style>

  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <img src="palio_logo_round.png" alt="Palio Logo" class="brand-image" style="max-width: 40px;">
            <strong>Palio.io</strong>
            <small class="float-right"><?php echo date('Y-m-d'); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-6 invoice-col">
          <br>
          <b>Invoice No.:</b> <?php echo $ordernumber; ?><br>
          <b>Order Date:</b> <?php echo $orderdate; ?><br>
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
                <th>Items</th>
                <!-- <th>Serial #</th> -->
                <!-- <th>Description</th> -->
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <strong>Palio Lite Package</strong>, which includes:
                  <ul>
                    <li>
                      Customer Engagement features on your app
                      <ul>
                        <li>
                          Mobile Contact Centers,
                        </li>
                        <li>
                          Push Notifications,
                        </li>
                        <li>
                          In-app Messaging,
                        </li>
                        <li>
                          Live Video Streaming,
                        </li>
                        <li>
                          Video and VoIP Calls
                        </li>
                      </ul>
                    </li>
                    <li>
                      Customer Engagement Credit that you can use for
                      <ul>
                        <li>
                          Up to 5,000,000 Monthly Text Recipients <sup>(1)</sup>
                        </li>
                        <li>
                          Up to 50,000 Monthly Image Recipients <sup>(2)</sup>
                        </li>
                        <li>
                          Up to 5,000 Monthly Video Recipients <sup>(3)</sup>
                        </li>
                        <li>
                          Up to 3,000 Monthly Minutes Livestream Recipients <sup>(4)</sup>
                        </li>
                        <li>
                          Up to 50,000 Monthly Minutes 1-1 VoIP Calls <sup>(5)</sup>
                        </li>
                        <li>
                          Up to 500 Monthly Minutes 1-1 Video Calls <sup>(6)</sup>
                        </li>
                      </ul>
                    </li>
                    <li>
                      Customer Support via Live Chat on catchUp
                    </li>
                  </ul>
                </td>
                <td>
                  $ <?php echo $price; ?>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row mb-3">
        <!-- accepted payments column -->
        <div class="col-6">
          <p class="lead">Payment Method:</p>
          <img src="cards.png" alt="Credit Card / Debit Card"><br>
          ( Credit Card / Debit Card, <?php echo $pay_when; ?> )
        </div>
        <!-- /.col -->
        <div class="col-6">

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td>
                  $ <?php echo $price; ?>
                </td>
              </tr>
              <tr>
                <th>Tax</th>
                <td>0</td>
              </tr>
              <!-- <tr>
                <th>Shipping:</th>
                <td>$5.80</td>
              </tr> -->
              <tr>
                <th>Total:</th>
                <td><strong>$ <?php echo $price; ?></strong></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-10">
          <ol id="hint-list" style="font-size:12px; padding-left: .8em;">
            <li>
              Up to 1,000 chars for each text. For each text sent, the credit will be deducted by the number of recipients of the message. For example, you can send 5,000 texts to 1,000 recipients.
            </li>
            <li>
              Up to 250 KB for each image. For each image sent, the credit will be deducted by the number of recipients of the image; For example, you can send 50 images to 1,000 recipients.
            </li>
            <li>
              Up to 2.5 MB for each video. For each video sent, the credit will be deducted by the number of recipients of the image; For example, you can send 5 videos to 1,000 recipients.
            </li>
            <li>
              Up to 3 minutes livestream to 1,000 recipients.
            </li>
            <li>
              If you, for example, have 10 team members, they can have 5,000 (50,000/10) minutes of VoIP Calls between them.
            </li>
            <li>
              If you, for example, have 10 team members, they can have 50 (500/10) minutes of Video Calls between them.
            </li>
          </ol>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->