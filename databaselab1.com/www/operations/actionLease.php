<?php
	session_start();
	@header('location: ../lease_to_pawnshop.php');
	
	function clean($value)
	{
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		
		return $value;
	}
	
	if(isset($_POST['add']))
	{
		$client_id = trim($_POST['client-id']);
		$product_id = trim($_POST['product-id']);
		$about = trim($_POST['about']);
		$date_come = trim($_POST['date-to']);
		$date_back = trim($_POST['date-undo']);
		$sum = trim($_POST['sum']);
		$comission = trim($_POST['comission']);
		
		$client_id  = addslashes($client_id);
		$product_id = addslashes($product_id);
		$date_come = addslashes($date_come);
		$date_back = addslashes($date_back);
		$sum = addslashes($sum);
		$comission = addslashes($comission);
		
		clean($client_id);
		clean($product_id);
		clean($date_come);
		clean($date_back);
		clean($sum);
		clean($comission);
		
		$query = "INSERT INTO dropto VALUES(NULL, '$client_id', '$product_id', '$about', '$date_come', '$date_back', '$sum', '$comission')";
		
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
		
		$query = "DELETE FROM dropto WHERE id = $id";
		
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