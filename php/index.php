<?php
	$db = new PDO('sqlite:../db/the_spoon.db') or die("Cannot open the database");
	$stmt = $db->prepare('SELECT * FROM users');
	$stmt->execute();
	$users = $stmt->fetchAll();
	
	foreach ($users as $user) {
		echo '<h1>' . $user['name'] . '</h1>';
	}
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>The Spoon</title>
</head>
<body>
	
</body>
</html>
