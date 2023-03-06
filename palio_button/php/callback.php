<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
print_r($_GET);

if(empty($_GET)){
	echo "null";
} else {
	echo "not null";
}

?>

</body>
</html>