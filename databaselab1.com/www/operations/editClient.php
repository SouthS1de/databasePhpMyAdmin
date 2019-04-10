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
	
	if(isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['middle-name']) && isset($_POST['passport-id']) && isset($_POST['passport-series']) && isset($_POST['passport-issue']) && isset($_POST['id']))
	{
		$id = trim($_POST['id']);
		$surname = trim($_POST['surname']);
		$name = trim($_POST['name']);
		$middle_name = trim($_POST['middle-name']);
		$passport_id = trim($_POST['passport-id']);
		$passport_series = trim($_POST['passport-series']);
		$passport_issue = trim($_POST['passport-issue']);
		
		$id = addslashes($id);
		$surname = addslashes($surname);
		$name = addslashes($name);
		$middle_name = addslashes($middle_name);
		$passport_id = addslashes($passport_id);
		$passport_series = addslashes($passport_series);
		$passport_issue = addslashes($passport_issue);
		
		clean($id);
		clean($surname);
		clean($name);
		clean($middle_name);
		clean($passport_id);
		clean($passport_series);
		clean($passport_issue);
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$query ="UPDATE clients SET surname='$surname', name='$name', middle_name='$middle_name', pass_id='$passport_id', pass_ser='$passport_series', date='$passport_issue' WHERE id='$id'";		
		$success = mysqli_query($mysqli, $query);
		if($success)
		{
			$_SESSION['response'] = "Запись была успешно изменена!";
			$_SESSION['res_type'] = "success";
		}
		else
		{
			$_SESSION['response'] = "Ошибка ввода данных! Запись не была изменена!";
			$_SESSION['res_type'] = "danger";
		}
		mysqli_close($mysqli);
		echo "<script type='text/javascript'>window.location.href = '../clients.php';</script>";
	}
	
	if (isset($_GET['edit']))
	{
		$id = $_GET['edit'];
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка!".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$query ="SELECT * FROM clients WHERE id = '$id'";
		$success = mysqli_query($mysqli, $query) or die("Ошибка!".mysqli_error($mysqli));
		if($success && mysqli_num_rows($success)>0)
		{
			$row = mysqli_fetch_row($success);
			$surname = $row[1];
			$name = $row[2];
			$middle_name = $row[3];
			$pass_id = $row[4];
			$pass_series = $row[5];
			$pass_issue = $row[6];
			
			echo "<h3 class='text-center text-info'>Изменить запись</h3>
			<form /*action='../product_categories.php'*/ method='POST' enctype='multipart/form-data'>
			<div class='form-group'>
			<input type='hidden' name='id' value='$id'class='form-control' placeholder='Введите ID клиента' required>
			</div>
			<p class='text-info'>Введите фамилию клиента:<br></p>
			<div class='form-group'>
			<input type='text' name='surname' value='$surname' class='form-control' placeholder='Введите фамилию клиента' required>
			</div>
			<p class='text-info'>Введите имя:<br></p>
			<div class='form-group'>
			<input type='text' name='name' value='$name' class='form-control' placeholder='Введите имя клиента' required>
			</div>
			<p class='text-info'>Введите отчество:<br></p>
			<div class='form-group'>
			<input type='text' name='middle-name' value='$middle_name' class='form-control' placeholder='Введите отчество клиента' required>
			</div>
			<p class='text-info'>Введите номер паспорта:<br></p>
			<div class='form-group'>
			<input type='text' name='passport-id' value='$pass_id' class='form-control' placeholder='Введите номер паспорта клиента' required>
			</div>
			<p class='text-info'>Введите серию паспорта:<br></p>
			<div class='form-group'>
			<input type='text' name='passport-series' value='$pass_series' class='form-control' placeholder='Введите серию паспорта клиента' required>
			</div>
			<p class='text-info'>Введите дату выдачи паспорта:<br></p>
			<div class='form-group'>
			<input type='text' name='passport-issue' value='$pass_issue' class='form-control' placeholder='Введите дату выдачи паспорта клиента' required>
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