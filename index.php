<?php 

// This sets up the table in the database: 
// require_once 'setup.php';

echo <<<_END
<h1>My Reading List</h1>

<form action="" method="post"><pre>
	Title <input type="text" name="title">
	Author <input type="text" name="author">
	Year <input type="text" name="year">
	ISBN <input type="text" name="isbn">
	<input type="submit" value="ADD RECORD">
	</pre></form>
_END;

