<?php

error_reporting( error_reporting() & ~E_NOTICE ); // evil

// config
$enable_jsonp    = false;
$enable_native   = false;
$valid_url_regex = '/.*/';

// ############################################################################

$url = $_GET['url'];
// $referenceid = $_GET['referenceid'];
if ($url == "https://uatmb.com:41405/eWallet/RequestAuthentication") {
    
    $referenceid = $_GET['referenceid'];
    
    $postVariables = json_encode(array("GrantType" => "client_credential","ReferenceID" => $referenceid));
    
    $httpheader = array("X-Requested-With: XMLHttpRequest", "Content-Type: application/json; charset=utf-8", "Authorization: Ux+P4xfBqT0rw68kgBHdTM2/bc+fZaNqvbaZl0njkt92ZtjxBCDbyQ==", "ClientID: A73EC6ED95507524E05400144FF98E94");
  
} elseif ($url == "https://uatmb.com:41405/eWallet/RequestTransactionPayment") {

    $merchantid = $_GET['merchantid'];
    $merchantname = $_GET['merchantname'];
    $amount = $_GET['amount'];
    $transactionid = $_GET['transactionid'];
    $requestdate = $_GET['requestdate'];
    $referenceid = $_GET['referenceid'];
    $callbackurl = $_GET['callbackurl'];
    $access_token = "Authorization: Bearer " . $_GET['access_token'];
    
    $postVariables = json_encode(array("MerchantID" => $merchantid, "MerchantName" => $merchantname, "Amount" => $amount, "Tax" => "0.0", "TransactionID" => $transactionid, "CurrencyCode" => "IDR", "RequestDate" => $requestdate, "ReferenceID" => $referenceid, "CallbackURL" => $callbackurl));
    
    $httpheader = array("X-Requested-With: XMLHttpRequest", "Content-Type: application/json; charset=utf-8", $access_token);
} 

if ( !$url ) {

  // Passed url not specified.
  $contents = 'ERROR: url not specified';
  $status = array( 'http_code' => 'ERROR' );

} else if ( !preg_match( $valid_url_regex, $url ) ) {

  // Passed url doesn't match $valid_url_regex.
  $contents = 'ERROR: invalid url';
  $status = array( 'http_code' => 'ERROR' );

} else {

  $ch = curl_init( $url );

  // @lf get domain from url and keep it around
  $parts = parse_url( $url );
  $domain = $parts['scheme']."://".$parts['host'];
//   echo "<script>alert(". var_dump($_GET) .");</script>";

  if ( strtolower($_SERVER['REQUEST_METHOD']) == 'post' ) {
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $postVariables );
  }

  if ( $_GET['send_cookies'] ) {
    $cookie = array();
    foreach ( $_COOKIE as $key => $value ) {
      $cookie[] = $key . '=' . $value;
    }
    if ( $_GET['send_session'] ) {
      $cookie[] = SID;
    }
    $cookie = implode( '; ', $cookie );

    curl_setopt( $ch, CURLOPT_COOKIE, $cookie );
  }

  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt( $ch, CURLOPT_HEADER, true );
//   curl_setopt( $ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest", "Content-Type: application/json; charset=utf-8", "Authorization: sQ/0yMIR/RW+JBYaKo6/oghsxVpVCotbVlfNei1EueE7Sw17/XcL0w==", "ClientID: A1370B764ABC4B2584FFB4D74ABE2BB8"));
  curl_setopt( $ch, CURLOPT_HTTPHEADER, $httpheader);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_ENCODING ,""); // @lf guess encoding automagically

  curl_setopt( $ch, CURLOPT_USERAGENT, $_GET['user_agent'] ? $_GET['user_agent'] : $_SERVER['HTTP_USER_AGENT'] );

  list( $header, $contents ) = preg_split( '/([\r\n][\r\n])\\1/', curl_exec( $ch ), 2 );

  // @lf filter any relative urls and replace them with absolute urls
  $rep['/href="(?!https?:\/\/)(?!data:)(?!#)/'] = 'href="'.$domain;
  $rep['/src="(?!https?:\/\/)(?!data:)(?!#)/'] = 'src="'.$domain;
  $rep['/href=\'(?!https?:\/\/)(?!data:)(?!#)/'] = 'href="'.$domain;
  $rep['/src=\'(?!https?:\/\/)(?!data:)(?!#)/'] = 'src="'.$domain;
  $rep['/@import[\n+\s+]"\//'] = '@import "'.$domain;
  $rep['/@import[\n+\s+]"\./'] = '@import "'.$domain;
  // @lf warning: clears previous contents
  $contents = preg_replace(array_keys($rep), array_values($rep), $contents);

  $status = curl_getinfo( $ch );

  curl_close( $ch );
}

// Split header text into an array.
$header_text = preg_split( '/[\r\n]+/', $header );

if ( $_GET['mode'] == 'native' ) {
  if ( !$enable_native ) {
    $contents = 'ERROR: invalid mode';
    $status = array( 'http_code' => 'ERROR' );
  }

  // Propagate headers to response.
  foreach ( $header_text as $header ) {
    if ( preg_match( '/^(?:Content-Type|Content-Language|Set-Cookie):/i', $header ) ) {
      header( $header );
    }
  }

  print $contents;

} else {

  // $data will be serialized into JSON data.
  $data = array();

  // Propagate all HTTP headers into the JSON data object.
  if ( $_GET['full_headers'] ) {
    $data['headers'] = array();

    foreach ( $header_text as $header ) {
      preg_match( '/^(.+?):\s+(.*)$/', $header, $matches );
      if ( $matches ) {
        $data['headers'][ $matches[1] ] = $matches[2];
      }
    }
  }

  // Propagate all cURL request / response info to the JSON data object.
  if ( $_GET['full_status'] ) {
    $data['status'] = $status;
  } else {
    $data['status'] = array();
    $data['status']['http_code'] = $status['http_code'];
  }

  // Set the JSON data object contents, decoding it from JSON if possible.
  $decoded_json = json_decode( $contents );
  $data['contents'] = $decoded_json ? $decoded_json : $contents;

  // Generate appropriate content-type header.
  $is_xhr = strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
  header( 'Content-type: application/' . ( $is_xhr ? 'json' : 'x-javascript' ) );

  // Get JSONP callback.
  $jsonp_callback = $enable_jsonp && isset($_GET['callback']) ? $_GET['callback'] : null;

  // Generate JSON/JSONP string
  $json = json_encode( $data );

  print $jsonp_callback ? "$jsonp_callback($json)" : $json;

}

?>