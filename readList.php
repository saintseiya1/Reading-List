<?php

	$dbhost = 'x';
	$dbname = 'x';
	$dbuser = 'x';
	$dbpass = 'x';

	$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($connection->connect_error) die ($connection->connect_error);


if (isset($_POST['delete']) && isset($_POST['id']))
{
	$id = get_post($connection, 'id');
	$query = "DELETE FROM list WHERE id='$id'";
	$result = $connection->query($query);
	if (!$result) echo "DELETE failed: $query<br>" .
		$connection->error . "<br><br>";
}
/*
*/

/*
if (isset($_POST['reset'])) {
	$query = "DROP TABLE IF EXISTS list";
	$connection->query($query);

	$newquery = 
		"CREATE TABLE list (
		id SMALLINT NOT NULL AUTO_INCREMENT,
		title VARCHAR(32) NOT NULL,
		author VARCHAR(32) NOT NULL,
		year SMALLINT NOT NULL,
		isbn CHAR(13),
		PRIMARY KEY(id)
	)";
	$result = $connection->query($newquery);
	if (!$result) die ("Database access failed: " . $connection->error);
	if ($result) echo "success!";
	$_POST['reset'] = null;


	<form action="read.php" method="post">
	<input type="hidden" name="reset" value="yes">
	<input type="submit" value="RESET"></form>
	</pre></form>

	<form action="read.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="DELETE RECORD"></form>

}
*/

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
		if (!$myresult) {
			$insertFailed = "INSERT failed: $myquery" . "\n" . $connection->error;
			insertFail($insertFailed);
		}
	}

echo "
	<style>
		body {
		background: lightgray;}
		table, th, td {
			border: 1px solid blue;
			border-collapse: collapse;
		}
		th, td {
		  padding: 5px;
		}
	</style>
";

function insertFail($insfail) {
	echo "<script>alert(`$insfail\n`);</script>";
};

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

	echo <<<_END
<table>
<tr><td>ID</td><td>Title</td><td>Author</td><td>Year</td><td>ISBN</td></tr>
<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>
</table>
	<form action="read.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" value="DELETE RECORD"></form>
_END;
}

/*
	Id $row[0];
	Title $row[1];
	Author $row[2];
	Year $row[3];
	ISBN $row[4];
*/

$result->close();
$connection->close();

function get_post($connection, $var) {
	return $connection->real_escape_string($_POST[$var]);
}

?>