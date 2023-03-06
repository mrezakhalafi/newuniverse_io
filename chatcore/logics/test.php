<?php 
	echo "string";
    echo($_SERVER['SERVER_NAME']);

    echo "test page \n";
    session_start();
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';


?>
