<?php
	session_start();
	if(isset($_POST['add']))
	{
		$name = trim($_POST['name']);
		$note = trim($_POST['note']);
		
		$name = addslashes($name);
		$note = addslashes($note);
		
		$query = "INSERT INTO categories VALUES(NULL, '$name', '$note')";
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		$success = mysqli_query($mysqli, $query) or die("Ошибка!".mysqli_error($mysqli));
		if($success)
		{
			$_SESSION['response'] = "Запись была успешно добавлена в таблицу!";
			$_SESSION['res_type'] = "success";
		}
		
		header('location: ../product_categories.php');
	}
?>