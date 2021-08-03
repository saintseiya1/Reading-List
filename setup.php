<!DOCTYPE html>
<html>
<head>
	<title>Setting up database</title>
</head>
<body>
	<h3>Setting up...</h3>

<?php
	$dbhost = 'localhost';
	$dbname = 'read_list';
	$dbuser = 'root';
	$dbpass = 'root';

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

	$query = "CREATE TABLE list (
		id SMALLINT NOT NULL AUTO_INCREMENT,
		title VARCHAR(32) NOT NULL,
		author VARCHAR(32) NOT NULL,
		year SMALLINT NOT NULL,
		isbn CHAR(13),
		PRIMARY KEY(id)
	)";

	$result = $connection->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	if ($result) echo "success!";
?>

</body>
</html>