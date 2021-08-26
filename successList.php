<?php

if (isset($_POST['save'])) {
echo <<<_END

<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
</head>
<body>
<h1>
	Save successful! This works!
</h1>
</body>
</html>

_END;
} else {
	echo "not working!";
}

?>