<?php
	session_start();
	@header('location: ../product_categories.php');
	
	function clean($value)
	{
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		
		return $value;
	}
	
	if(isset($_POST['add']))
	{
		$name = trim($_POST['name']);
		$note = trim($_POST['note']);
		
		$name = addslashes($name);
		$note = addslashes($note);

		clean($name);
		clean($note);
		
		$query = "INSERT INTO categories VALUES(NULL, '$name', '$note')";
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		$success = mysqli_query($mysqli, $query) or die("Ошибка!".mysqli_error($mysqli));
		if($success)
		{
			$_SESSION['response'] = "Запись была успешно добавлена в таблицу!";
			$_SESSION['res_type'] = "success";
		}
		mysqli_close($mysqli);		
	}
	
	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		
		$query = "DELETE FROM categories WHERE id = $id";
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$success = mysqli_query($mysqli, $query) or die("Ошибка!".mysqli_error($mysqli));
		if($success)
		{
			$_SESSION['response'] = "Запись была успешно удалена из таблицы!";
			$_SESSION['res_type'] = "success";
		}
		mysqli_close($mysqli);
	}	
?>