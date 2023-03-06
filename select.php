<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/db_conn.php'); 

// cek email
$dbconn = getDBConn();
$query = $dbconn->prepare("SELECT * FROM USER_ACCOUNT");
$query->execute();
$result = $query->get_result();
$query->close();

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["ID"]. " - Name: " . $row["USERNAME"]. " | email : " . $row["EMAIL_ACCOUNT"]. " | status : " . $row["STATUS"]. "<br>";
    }
  } else {
    echo "0 results";
  }

?>