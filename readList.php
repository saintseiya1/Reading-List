<?php

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'root';
	$dbname = 'read_list';

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
			$insertFailed = "INSERT failed: $myquery" . "<br />" . $connection->error;
			insertFail($insertFailed);
		}
}

echo '<link rel="stylesheet" href="readList.css" /> ';

function insertFail($insfail) {
	echo "<script>
			alert('Please insert proper values');
			</script>";
	echo $insfail;
}

echo <<<_END
<form class="readForm" action="readList.php" method="post">
	<pre><h3 class="title">My Reading List</h3>
	Id 	<input type="text" name="id">
	Title 	<input type="text" name="title">
	Author 	<input type="text" name="author">
	Year 	<input type="text" name="year">
	ISBN 	<input type="text" name="isbn">
			<input type="submit" class="add" value="ADD RECORD"></pre>
</form>
<table><tbody>
<tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th></tr>
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
<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>
<td>
	<form action="readList.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="id" value="$row[0]">
<input type="submit" class="delete" value="     DELETE RECORD"></form>
</td></tr>
_END;
}

echo "</tbody></table>";

$result->close();
$connection->close();

function get_post($connection, $var) {
	return $connection->real_escape_string($_POST[$var]);
}

?>