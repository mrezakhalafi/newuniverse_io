<?php
    // $entityBody = file_get_contents('php://input');

    $entityBody = '{"FlagStatus":"00","ReasonStatus":{"Indonesian":"Sukses.","English":"Success."}}';
    $decoded = json_decode($entityBody);
    // $encoded = json_encode($decoded);

    // print json_encode($decoded);
?>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="jumbotron text-center">
  <p>
    <?php print_r($decoded); ?>
    <?php echo "<br>";?>
    <?php echo("Flag Status = " . $decoded->FlagStatus); ?>
    <?php echo "<br>";?>
    <?php echo("Flag Reason = " . $decoded->ReasonStatus->Indonesian); ?>
  </p>
</div>
</body>
</html>