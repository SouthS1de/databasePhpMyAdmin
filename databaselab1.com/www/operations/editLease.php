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
	
	if(isset($_POST['client-id']) && isset($_POST['product-id']) && isset($_POST['about']) && isset($_POST['date-to']) && isset($_POST['date-undo']) && isset($_POST['sum']) && isset($_POST['comission']) && isset($_POST['id']))
	{
		$id = trim($_POST['id']);
		$client_id = trim($_POST['client-id']);
		$product_id = trim($_POST['product-id']);
		$about = trim($_POST['about']);
		$date_come = trim($_POST['date-to']);
		$date_back = trim($_POST['date-undo']);
		$sum = trim($_POST['sum']);
		$comission = trim($_POST['comission']);
		
		$id = addslashes($id);
		$client_id  = addslashes($client_id);
		$product_id = addslashes($product_id);
		$date_come = addslashes($date_come);
		$date_back = addslashes($date_back);
		$sum = addslashes($sum);
		$comission = addslashes($comission);
		
		clean($id);
		clean($client_id);
		clean($product_id);
		clean($date_come);
		clean($date_back);
		clean($sum);
		clean($comission);
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка ".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$query ="UPDATE dropto SET client_id='$client_id', product_id='$product_id', product_description='$about', date_to='$date_come', date_undo='$date_back', summ='$sum', comission='$comission' WHERE id='$id'";		
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
		echo "<script type='text/javascript'>window.location.href = '../lease_to_pawnshop.php';</script>";
	}
	
	if (isset($_GET['edit']))
	{
		$id = $_GET['edit'];
		
		$mysqli = mysqli_connect("localhost", "root", "", "pawnshopbase") or die("Ошибка!".mysqli_error($mysqli));
		mysqli_set_charset($mysqli, "utf8");
		
		$query ="SELECT * FROM dropto WHERE id = '$id'";
		$success = mysqli_query($mysqli, $query) or die("Ошибка!".mysqli_error($mysqli));
		if($success && mysqli_num_rows($success)>0)
		{
			$row = mysqli_fetch_row($success);
			$client_id = $row[1];
			$product_id = $row[2];
			$about = $row[3];
			$date_come = $row[4];
			$date_back = $row[5];
			$sum = $row[6];
			$comission = $row[7];
			
			echo "<h3 class='text-center text-info'>Изменить запись</h3>
			<form method='POST' enctype='multipart/form-data'>
			<div class='form-group'>
			<input type='hidden' name='id' value='$id'class='form-control' placeholder='Введите ID' required>
			</div>
			<p class='text-info'>Выберите код клиента:<br></p>
			<div class='form-group'>
			<select name='client-id' class='custom-select'>
					<option value='$client_id' selected>$client_id</option>";
							$mysqli1 = new mysqli("localhost", "root", "", "pawnshopbase");
							$mysqli1->query("SET NAMES 'utf8'");

							$result = $mysqli1->query("SELECT * FROM `clients` ORDER BY `ID` ASC");
							if($result)
							{
								$rows = mysqli_num_rows($result);

								for($i = 0; $i < $rows; ++$i)
								{
									$row = mysqli_fetch_row($result); 
									echo "<option value='$row[0]'>$row[0] $row[1] $row[2] $row[3]</option>";
								}								
							}
							mysqli_free_result($result);
							$mysqli1->close();
					echo"</select>
			</div>
			<p class='text-info'>Выберите код товара:<br></p>
			<div class='form-group'>
			<select name='product-id' class='custom-select'>
					<option value='$product_id' = selected>$product_id</option>";
							$mysqli1 = new mysqli("localhost", "root", "", "pawnshopbase");
							$mysqli1->query("SET NAMES 'utf8'");

							$result = $mysqli1->query("SELECT * FROM `categories` ORDER BY `ID` ASC");
							if($result)
							{
								$rows = mysqli_num_rows($result);

								for($i = 0; $i < $rows; ++$i)
								{
									$row = mysqli_fetch_row($result); 
									echo "<option value='$row[0]'>$row[0] $row[1]</option>";
								}								
							}
							mysqli_free_result($result);
							$mysqli1->close();
					echo"</select>
			</div>
			<p class='text-info'>Введите описание товара:<br></p>
			<div class='form-group'>
			<input type='text' name='about' value='$about' class='form-control' placeholder='Введите описание товара' required>
			</div>
			<p class='text-info'>Введите дату, когда поступил товар (YYYY-MM-DD):<br></p>
			<div class='form-group'>
			<input type='text' name='date-to' value='$date_come' class='form-control' placeholder='Введите номер паспорта клиента' required>
			</div>
			<p class='text-info'>Введите дату, до которой нужно забрать товар (YYYY-MM-DD):<br></p>
			<div class='form-group'>
			<input type='text' name='date-undo' value='$date_back' class='form-control' placeholder='Введите дату, до которой нужно забрать товар' required>
			</div>
			<p class='text-info'>Введите сумму, выплачиваемую за товар:<br></p>
			<div class='form-group'>
			<input type='text' name='sum' value='$sum' class='form-control' placeholder='Введите сумму' required>
			</div>
			<p class='text-info'>Введите сумму комиссии:<br></p>
			<div class='form-group'>
			<input type='text' name='comission' value='$comission' class='form-control' placeholder='Введите сумму комиссии' required>
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