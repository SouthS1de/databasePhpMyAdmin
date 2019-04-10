<?php 
@session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Изменение записи</title>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
		function clean($value)
	{
		$value = stripslashes($value);
		$value = strip_tags($value);
		$value = htmlspecialchars($value);
		
		return $value;
	}
	
	if(isset($_POST['name']) && isset($_POST['note']) && isset($_POST['id']))
	{
		$id = trim($_POST['id']);
		$name = trim($_POST['name']);
		$note = trim($_POST['note']);
		
		$id = addslashes($id);
		$name = addslashes($name);
		$note = addslashes($note);
		
		clean($id);
		clean($name);
		clean($note);
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$query ="UPDATE categories SET name='$name', note='$note' WHERE id='$id'";		
		$success = mysqli_query($mysqli, $query) or die("Ошибка ".mysqli_error($mysqli));
		if($success)
		{
			$_SESSION['response'] = "Запись была успешно изменена!";
			$_SESSION['res_type'] = "success";
		}
		mysqli_close($mysqli);
		echo "<script type='text/javascript'>window.location.href = '../product_categories.php';</script>";
	}
	
	if (isset($_GET['edit']))
	{
		$id = $_GET['edit'];
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$query ="SELECT * FROM categories WHERE id = '$id'";
		$success = mysqli_query($mysqli, $query) or die("Ошибка ".mysqli_error($mysqli));
		if($success && mysqli_num_rows($success)>0)
		{
			$row = mysqli_fetch_row($success);
			$name = $row[1];
			$note = $row[2];
			
			echo "<h3 class='text-center text-info'>Изменить запись</h3>
			<form /*action='../product_categories.php'*/ method='POST' enctype='multipart/form-data'>
			<div class='form-group'>
			<input type='hidden' name='id' value='$id'class='form-control' placeholder='Введите ID товара' required>
			</div>
			<p class='text-info'>Введите название:<br></p>
			<div class='form-group'>
			<input type='text' name='name' value='$name' class='form-control' placeholder='Введите название товара' required>
			</div>
			<p class='text-info'>Примечание:<br></p>
			<div class='form-group'>
			<input type='text' name='note' value='$note' class='form-control' placeholder='Введите примечание' required>
			</div>
			<div class='form-group'>
			<input type='submit' name='save' class='btn btn-info btn-block' value='Сохранить'>
			</div>
			</form>";
			mysqli_free_result($success);
		}
		mysqli_close($mysqli);
	}
?>
</body>
</html>