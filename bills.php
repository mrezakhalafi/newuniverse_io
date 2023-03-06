<link rel="icon" type="image/x-icon" href="newAssets/fav.ico">
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/headerdashboard.php'); ?>
<?php
  session_start();
  // $query = $dbconn->prepare("SELECT b.ID as payment_id, b.COMPANY, b.FEATURE_SUBSCRIBE, b.CARD, SUM(b.BILL) as BILL, b.DATE, b.IS_PAID FROM `payment` b  WHERE b.company= ?  AND a.START_DATE < ? group by b.DATE");

  // $result='';
  // $startdate= '';
  // $untildate ='';

  // $startdate = $_GET['startDate'];
  // $untildate = $_GET['endDate'];
  // if(isset($_GET['startDate'])){
    

  //   $query = $dbconn->prepare("SELECT a.*, b.ID as payment_id, b.COMPANY, b.FEATURE_SUBSCRIBE, b.CARD, SUM(b.BILL) as BILL, b.DATE, b.IS_PAID FROM `feature_subscribe` a , `payment` b  WHERE b.feature_subscribe = a.ID AND b.company= ?  AND a.START_DATE > ? AND a.START_DATE < ? group by a.START_DATE");
  //   $query->bind_param("iss", getSession('id_company'),$startdate,$untildate );

  //   $query->execute();
  //   $result = $query->get_result();
  // }else{
  //   $query = $dbconn->prepare("SELECT a.*, b.ID as payment_id, b.COMPANY, b.FEATURE_SUBSCRIBE, b.CARD, SUM(b.BILL) as BILL, b.DATE, b.IS_PAID FROM `feature_subscribe` a , `payment` b  WHERE b.feature_subscribe = a.ID AND b.company= ? group by a.START_DATE");
  //   $query->bind_param("i", getSession('id_company'));
  //   $query->execute();
  //   $result = $query->get_result();
  // }

  // if(isset($_POST['export'])){
    if(isset($_GET['startDate'])){
      $startdate = $_GET['startDate'];
      $untildate = $_GET['endDate'];
      $table_name = "NUs Billing_" . $startdate . "_" . $untildate; 
	  // header('location:download_excel.php?startDate='.$startdate.'&endDate='.$untildate);
	  // echo "<script type=\"text/javascript\">
    //     window.open('download_excel.php?startDate=".$startdate."&endDate=".$untildate."', '_blank')
		// </script>";
	
      // redirect(base_url().'download_excel.php?startDate='.$startdate.'&endDate='.$untildate);
	  
    } else {
      $startdate = "2020-01-01";
      $untildate = date("Y-m-d");
      $table_name = "NUs Billing_" . $startdate . "_" . $untildate;
	  // header('location:download_excel.php?startDate=&endDate=');
	  // echo "<script type=\"text/javascript\">
    //     window.open('download_excel.php?startDate=&endDate=', '_blank')
		// </script>";

      // redirect(base_url().'download_excel.php?startDate=&endDate=');

    }
  // }

  if(isset($_GET['startDate'])){
    $query= $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? and DUE_DATE between ? and ? order by DUE_DATE desc");
    $query->bind_param("iss", $_SESSION['id_company'], $_GET['startDate'], $_GET['endDate']);
    $query->execute();
    $bills = array();
    $bills = $query->get_result(); //GET COLUMNS
    $query->close();
  } else {
    $query= $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc");
    $query->bind_param("i", $_SESSION['id_company']);
    $query->execute();
    $bills = array();
    $bills = $query->get_result(); //GET COLUMNS
    $query->close();
  }

  //BILL COUNT
  // $query= $dbconn->prepare("SELECT * FROM BILLING WHERE COMPANY = ?");
  // $query->bind_param("i", $_SESSION['id_company']);
  // $query->execute();
  // $bills = array();
  // $bills = $query->get_result(); //GET COLUMNS
  // $query->close();
  // while($row = $query->get_result()->fetch_assoc()){
  //   $bills[] = row;
  // }

  // $record=mysql_query("SELECT * FROM BILLING");
  // $list = array();
  // while($row=mysql_fetch_assoc($record)){
  //       //fill array how to fill array that will look like bellow from database???
  //     $list[] = row;
  // }

  //ISSUE DATE
  $query= $dbconn->prepare("SELECT BILL_DATE FROM BILLING WHERE COMPANY = ? order by DUE_DATE desc");
  $query->bind_param("i", $_SESSION['id_company']);
  $query->execute();
  $bill_date_array = $query->get_result()->fetch_assoc();
  $bill_date = $bill_date_array['BILL_DATE'];
  $query->close();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper px-3">

  <div class="container px-1">
    <div class="card mx-3 isi">
      <div class="card-body d-flex">
        <div class="pull-left align-self-center">
          <span class="ml-1 fs-14 fc-70"><b>Bill and Payment</b></span>
        </div>
      </div>
    </div>

    <div class="card m-3">
      <div class="card-body">
        <ol class="my-3 fs-12 fc-70">
          <li>Your monthly billing will be available on the 1st date of each month.</li>
          <li>Your balance will be deducted by the billing amount on the 6th date of each month.</li>
          <li>By default, if your balance remains negative over 30 days, your account will be suspended according to the terms of service.</li>
          <li>Access to all projects will be disabled if your account is suspended, however you can still log in to the dashboard to make the payment.</li>
          <li>Once all dues are paid via the preferred method of payment, your account will be resumed immediately.</li>
          <li>All payment notifications including monthly billing payments, refunds/credit, account suspensions and account summary will be notified via email or text message.</li>
        </ol>
        <form method="post">
          <div class="row mb-2 px-3 justify-content-lg-end">
            <div class="col-8 col-lg-3 d-flex p-0" style="border: 1px solid #C7C7C7; border-radius: 5px;">
              <i class="fa fa-calendar align-self-center ml-2" style="color: #C7C7C7;"></i>
              <input type="text" class="form-control border-0 text-center fs-13" name="daterange">
            </div>
            <div class="col-4 col-lg-2 pr-0">
              <button type="submit" name="export" onclick="javascript:xport.toCSV('<?php echo $table_name; ?>');" class="w-100 h-100 fs-13 export-button">Export Excel</button>
            </div>
          </div>
        </form>
        <div class="row m-0" style="overflow-x: auto;">
          <table id="<?php echo $table_name; ?>" class="table w-100">
            <thead>
              <tr style="background-color: #f2f2f2;">
                <th scope="col" class="fs-14">Issue Date</th>
                <th scope="col" class="fs-14">Billing Period</th>
                <th scope="col" class="fs-14">Due Date</th>
                <th scope="col" class="fs-14">Amount</th>
                <th scope="col" class="fs-14">Status</th>
                <th scope="col" class="fs-14">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($bills as $bill){ ?>
              <tr>
                <td class="fs-12">
                  <?php print_r($bill[BILL_DATE]); ?> <br>
                </td>
                <td class="fs-12">
                  <?php 
                    //BILLING PERIOD
                    $issue_date = strtotime($bill[BILL_DATE]);
                    $secs = strtotime(date("Y-m-d H:i:s")) - $issue_date;// == <seconds between the two times>
                    $billing_period = $secs / 86400;
                    // $int = int($billing_period);
                    if( floor($billing_period) < 0){ echo("1"); } else { echo( floor($billing_period) + 1); }
                  ?>
                </td>
                <td class="fs-12">
                  <?php print_r($bill[DUE_DATE]); ?>
                </td>
                <td class="fs-12">
                  <?php echo("$" . $bill[CHARGE]); ?>
                </td>
                <td class="fs-12">
                  <?php if($bill[IS_PAID] == 1){ echo("PAID"); } else { echo("UNPAID"); } ?>
                </td>
                <td class="fs-12">
                  <?php
                    if($bill[IS_PAID] == 0){
                      echo '<a href="paycheckout.php?company='.$_SESSION['id_company'].'&bill='.$bill[ID].'" class="btn fs-12 text-light py-1" style="background-color: #F7941F;">Pay</a>';
                    } elseif($bill['IS_PAID'] == 1) {
                      echo '-';
                    } elseif($bill['IS_PAID'] == 2) {
                      echo '-';
                    }
                  ?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalPay">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 650px;">
        <div class="modal-content">
          <div class="modal-body fontRobReg px-4">
            <div class="container-fluid">
              <div class="row mx-0 my-1">
                <p class="fs-25 m-0">Bill</p>
              </div>
              <div class="row mx-0 mb-2">
                <p class="fs-20 text-secondary">Subscribe : Growing</p>
              </div>
              <div class="row mx-0 my-2" style="border-bottom: 1px solid black;">
                <p class="fs-18 mb-0">Total</p>
                <p class="fs-18 ml-auto mb-0">$ 50</p>
              </div>
              <div class="row mx-0 my-3">
                <p class="fs-15 m-0">Payment Method :</p>
              </div>
              <div class="row mx-0 mb-3">
                <div class="col-md-6 px-0 d-flex justify-content-center justify-content-sm-start my-sm-0 my-3">
                  <button type="submit" class="btn text-light fs-15 h-100" style="background-color: #1A71E8; width: 240px;">Pay with PayPal</button>
                </div>
                <div class="col-md-6 px-0 d-flex justify-content-center justify-content-sm-end my-sm-0 my-3">
                  <div id="paydiv"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php if($_GET['day'] == 'y'):?>

<?php
    $query = $dbconn->prepare('SELECT DATE_FORMAT(CAST(DATE as date), "%m/%d/%Y") as DATE from history_usage WHERE COMPANY = ? ORDER BY DATE');
    $query->bind_param("i", getSession('id_company'));
    $query->execute();
    $date_range = $query->get_result();

    $data = array();
    while($row = $date_range->fetch_assoc()){
        array_push($data, $row['DATE']);
    }
?>

<script type="text/javascript">
    $('input[name="daterange"]').daterangepicker({
        startDate: '<?php echo $data[0]; ?>',
        endDate: '<?php echo $data[count($data)-1]; ?>'
    });
</script>

<?php endif; ?>

<!-- /.content-wrapper -->
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
    $('.nav-dashboard.pay').addClass('active');
    $('input[name="daterange"]').daterangepicker();
    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker){

        window.location = "bills.php?startDate="+picker.startDate.format('YYYY-MM-DD')+"&endDate="+picker.endDate.format('YYYY-MM-DD');
    });

    
</script>

<script>
/**
 * Define the version of the Google Pay API referenced when creating your
 * configuration
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
 */
const baseRequest = {
  apiVersion: 2,
  apiVersionMinor: 0
};

/**
 * Card networks supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm card networks supported by your site and gateway
 */
const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];

/**
 * Card authentication methods supported by your site and your gateway
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 * @todo confirm your processor supports Android device tokens for your
 * supported card networks
 */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

/**
 * Identify your gateway and your site's gateway merchant identifier
 *
 * The Google Pay API response will return an encrypted payment method capable
 * of being charged by a supported gateway after payer authorization
 *
 * @todo check with your gateway on the parameters to pass
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
 */
const tokenizationSpecification = {
  type: 'PAYMENT_GATEWAY',
  parameters: {
    'gateway': 'example',
    'gatewayMerchantId': 'exampleGatewayMerchantId'
  }
};

/**
 * Describe your site's support for the CARD payment method and its required
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const baseCardPaymentMethod = {
  type: 'CARD',
  parameters: {
    allowedAuthMethods: allowedCardAuthMethods,
    allowedCardNetworks: allowedCardNetworks
  }
};

/**
 * Describe your site's support for the CARD payment method including optional
 * fields
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
 */
const cardPaymentMethod = Object.assign(
  {},
  baseCardPaymentMethod,
  {
    tokenizationSpecification: tokenizationSpecification
  }
);

/**
 * An initialized google.payments.api.PaymentsClient object or null if not yet set
 *
 * @see {@link getGooglePaymentsClient}
 */
let paymentsClient = null;

/**
 * Configure your site's support for payment methods supported by the Google Pay
 * API.
 *
 * Each member of allowedPaymentMethods should contain only the required fields,
 * allowing reuse of this base request when determining a viewer's ability
 * to pay and later requesting a supported payment method
 *
 * @returns {object} Google Pay API version, payment methods supported by the site
 */
function getGoogleIsReadyToPayRequest() {
  return Object.assign(
      {},
      baseRequest,
      {
        allowedPaymentMethods: [baseCardPaymentMethod]
      }
  );
}

/**
 * Configure support for the Google Pay API
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
 * @returns {object} PaymentDataRequest fields
 */
function getGooglePaymentDataRequest() {
  const paymentDataRequest = Object.assign({}, baseRequest);
  paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
  paymentDataRequest.merchantInfo = {
    // @todo a merchant ID is available for a production environment after approval by Google
    // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
    // merchantId: '01234567890123456789',
    merchantName: 'Example Merchant'
  };
  return paymentDataRequest;
}

/**
 * Return an active PaymentsClient or initialize
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
 * @returns {google.payments.api.PaymentsClient} Google Pay API client
 */
function getGooglePaymentsClient() {
  if ( paymentsClient === null ) {
    paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
  }
  return paymentsClient;
}

/**
 * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
 *
 * Display a Google Pay payment button after confirmation of the viewer's
 * ability to pay.
 */
function onGooglePayLoaded() {
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
      .then(function(response) {
        if (response.result) {
          addGooglePayButton();
          // @todo prefetch payment data to improve performance after confirming site functionality
          // prefetchGooglePaymentData();
        }
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Add a Google Pay purchase button alongside an existing checkout button
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
 * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
 */
function addGooglePayButton() {
  const paymentsClient = getGooglePaymentsClient();
  const button =
      paymentsClient.createButton({onClick: onGooglePaymentButtonClicked});
  document.getElementById('paydiv').appendChild(button);
}

/**
 * Provide Google Pay API with a payment amount, currency, and amount status
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
 * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
 */
function getGoogleTransactionInfo() {
  return {
    countryCode: 'US',
    currencyCode: 'USD',
    totalPriceStatus: 'FINAL',
    // set to cart total
    totalPrice: '1.00'
  };
}

/**
 * Prefetch payment data to improve performance
 *
 * @see {@link https://developers.google.com/pay/api/web/reference/client#prefetchPaymentData|prefetchPaymentData()}
 */
function prefetchGooglePaymentData() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  // transactionInfo must be set but does not affect cache
  paymentDataRequest.transactionInfo = {
    totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
    currencyCode: 'USD'
  };
  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.prefetchPaymentData(paymentDataRequest);
}

/**
 * Show Google Pay payment sheet when Google Pay payment button is clicked
 */
function onGooglePaymentButtonClicked() {
  const paymentDataRequest = getGooglePaymentDataRequest();
  paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

  const paymentsClient = getGooglePaymentsClient();
  paymentsClient.loadPaymentData(paymentDataRequest)
      .then(function(paymentData) {
        // handle the response
        processPayment(paymentData);
      })
      .catch(function(err) {
        // show error in developer console for debugging
        console.error(err);
      });
}

/**
 * Process payment data returned by the Google Pay API
 *
 * @param {object} paymentData response from Google Pay API after user approves payment
 * @see {@link https://developers.google.com/pay/api/web/reference/response-objects#PaymentData|PaymentData object reference}
 */
function processPayment(paymentData) {
  // show returned data in developer console for debugging
    console.log(paymentData);
  // @todo pass payment token to your gateway to process payment
  paymentToken = paymentData.paymentMethodData.tokenizationData.token;
}

</script>

<script>
var xport = {
  _fallbacktoCSV: true,
  toCSV: function(tableId, filename) {
    this._filename = (typeof filename === 'undefined') ? tableId : filename;
    // Generate our CSV string from out HTML Table
    var csv = this._tableToCSV(document.getElementById(tableId));
    // Create a CSV Blob
    var blob = new Blob([csv], { type: "text/csv" });

    // Determine which approach to take for the download
    if (navigator.msSaveOrOpenBlob) {
      // Works for Internet Explorer and Microsoft Edge
      navigator.msSaveOrOpenBlob(blob, this._filename + ".csv");
    } else {      
      this._downloadAnchor(URL.createObjectURL(blob), 'csv');      
    }
  },
  _getMsieVersion: function() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf("MSIE ");
    if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)), 10);
    }

    var trident = ua.indexOf("Trident/");
    if (trident > 0) {
      // IE 11 => return version number
      var rv = ua.indexOf("rv:");
      return parseInt(ua.substring(rv + 3, ua.indexOf(".", rv)), 10);
    }

    var edge = ua.indexOf("Edge/");
    if (edge > 0) {
      // Edge (IE 12+) => return version number
      return parseInt(ua.substring(edge + 5, ua.indexOf(".", edge)), 10);
    }

    // other browser
    return false;
  },
  _isFirefox: function(){
    if (navigator.userAgent.indexOf("Firefox") > 0) {
      return 1;
    }
    
    return 0;
  },
  _downloadAnchor: function(content, ext) {
      var anchor = document.createElement("a");
      anchor.style = "display:none !important";
      anchor.id = "downloadanchor";
      document.body.appendChild(anchor);

      // If the [download] attribute is supported, try to use it
      
      if ("download" in anchor) {
        anchor.download = this._filename + "." + ext;
      }
      anchor.href = content;
      anchor.click();
      anchor.remove();
  },
  _tableToCSV: function(table) {
    // We'll be co-opting `slice` to create arrays
    var slice = Array.prototype.slice;

    return slice
      .call(table.rows)
      .map(function(row) {
        return slice
          .call(row.cells)
          .map(function(cell) {
            return '"t"'.replace("t", cell.textContent);
          })
          .join(",");
      })
      .join("\r\n");
  }
};
</script>

<script async
  src="https://pay.google.com/gp/p/js/pay.js"
  onload="onGooglePayLoaded()"></script>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/footerdashboard.php'); ?>
