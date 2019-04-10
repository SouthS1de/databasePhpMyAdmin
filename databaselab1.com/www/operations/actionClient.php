<?php
	session_start();
	@header('location: ../clients.php');
	
	function clean($value)
	{
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		
		return $value;
	}
	
	if(isset($_POST['add']))
	{
		$surname = trim($_POST['surname']);
		$name = trim($_POST['name']);
		$middle_name = trim($_POST['middle-name']);
		$passport_id = trim($_POST['passport-id']);
		$passport_series = trim($_POST['passport-series']);
		$passport_issue = trim($_POST['passport-issue']);
		
		$surname = addslashes($surname);
		$name = addslashes($name);
		$middle_name = addslashes($middle_name);
		$passport_id = addslashes($passport_id);
		$passport_series = addslashes($passport_series);
		$passport_issue = addslashes($passport_issue);
		
		clean($surname);
		clean($name);
		clean($middle_name);
		clean($passport_id);
		clean($passport_series);
		clean($passport_issue);
		
		$query = "INSERT INTO clients VALUES(NULL, '$surname', '$name', '$middle_name', '$passport_id', '$passport_series', '$passport_issue')";
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка!".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		$success = mysqli_query($mysqli, $query);
		if($success)
		{
			$_SESSION['response'] = "Запись была успешно добавлена в таблицу!";
			$_SESSION['res_type'] = "success";
		}
		else
		{
			$_SESSION['response'] = "Ошибка ввода данных! Запись не была добавлена!";
			$_SESSION['res_type'] = "danger";
		}
		mysqli_close($mysqli);		
	}
	
	if(isset($_GET['delete']))
	{
		$id = $_GET['delete'];
		
		$query = "DELETE FROM clients WHERE id = $id";
		
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