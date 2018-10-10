<?php
		$sec = 60 * 5; //5 minutes
		
		$cookie = isset($_COOKIE["monCookie"]) ? $_COOKIE["monCookie"] + 1 : 0;
		setcookie("monCookie",$cookie,time()+$sec);

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Cookie</title>
</head>
<body>
	<?php
		echo "Cookie:" . $cookie;
		//unset($_COOKIE["monCookie"]);
	?>
</body>
</html>