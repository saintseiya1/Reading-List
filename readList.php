<?php

	$dbhost = 'x';
	$dbname = 'x';
	$dbuser = 'x';
	$dbpass = 'x';

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

function get_post($connection, $var) {
	return $connection->real_escape_string($_POST[$var]);
}

if (isset($_POST['id']) &&
	isset($_POST['title']) &&
	isset($_POST['author']) &&
	isset($_POST['year']) &&
	isset($_POST['isbn'])) {

		$id = get_post($connection, 'id');
		$title = get_post($connection, 'title');
		$author = get_post($connection, 'author');
		$year = get_post($connection, 'year');
		$isbn = get_post($connection, 'isbn');

		$myquery = "INSERT INTO list VALUES" ."('$id', '$title', '$author', '$year', '$isbn')";
		$myresult = $connection->query($myquery);
		if (!$myresult) echo "INSERT failed: $myquery<br>" . 
			$connection->error . "<br><br>";
	}

echo <<<_END
<h3>My Reading List</h3>

<form action="read.php" method="post"><pre>
	Id <input type="text" name="id">
	Title <input type="text" name="title">
	Author <input type="text" name="author">
	Year <input type="text" name="year">
	ISBN <input type="text" name="isbn">
	<input type="submit" value="ADD RECORD">
	</pre></form>
_END;

$query = "SELECT * FROM list";
$result = $connection->query($query);
if (!$result) die ("Database access failed: " . $connection->error);

$rows = $result->num_rows;

for ($j = 0; $j < $rows; ++$j)
{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);

	echo <<<_NEW
<pre>
<hr />
	Id $row[0];
	Title $row[1];
	Author $row[2];
	Year $row[3];
	ISBN $row[4];
</pre>
_NEW;
}

$result->close();
$connection->close();

?>