<?php
		session_start();
		if (!isset($_SESSION['maVariableSession']))
		{
		  $_SESSION['maVariableSession'] = 0;
		} 
		else
		{
		  $_SESSION['maVariableSession']++;
		}

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Session</title>
</head>
<body>
	<?php
		echo "Session:" . $_SESSION['maVariableSession'];
		//unset($_SESSION['maVariableSession']);
	?>
</body>
</html>