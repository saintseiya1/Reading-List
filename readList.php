<?php 

// This sets up the table in the database: 
// require_once 'setup.php';
	$dbhost = 'x';
	$dbname = 'x';
	$dbuser = 'x';
	$dbpass = 'x';

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

function get_post($connection, $var) {
	return $connection->real_escape_string($_POST[$var]);
}
if (isset($_POST['title']))
	$title = get_post($connection, 'title');
	$myquery = "INSERT INTO list VALUES" . "('$title')";
	var_dump($myquery);
	$result = $connection->query($myquery);
	if (!$result) echo "INSERT failed: $myquery<br>" .
		$connection->error . "<br><br>";



echo <<<_END
<h1>My Reading List</h1>

<form action="readList.php" method="post"><pre>
	Title <input type="text" name="title">
	Author <input type="text" name="author">
	Year <input type="text" name="year">
	ISBN <input type="text" name="isbn">
	<input type="submit" value="ADD RECORD">
	</pre></form>
_END;



