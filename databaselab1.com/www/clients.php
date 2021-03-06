﻿<!DOCTYPE html>
<html>
<head>
	<title>Клиенты</title>
	<meta charset="utf-8">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
	  <!-- Brand -->
	  <a class="navbar-brand" href="http://www.databaselab1.com/">Ломбард</a>

	  <!-- Toggler/collapsibe Button -->
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <!-- Navbar links -->
	  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	    <ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" href="http://www.databaselab1.com/clients.php">Клиенты</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="http://www.databaselab1.com/product_categories.php">Категории товаров</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="http://www.databaselab1.com/lease_to_pawnshop.php">Сдача в ломбард</a>
	      </li>
		  <li class="nav-item">
	        <a class="nav-link" href="http://www.databaselab1.com/documentation.php">Документация</a>
	      </li>	
	    </ul>
	  </div> 
	</nav>

	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<h3 class="text-center text-dark mt-2">Таблица клиентов</h3>
				<hr>
				<?php @session_start(); if(isset($_SESSION['response'])){ ?>
				<div class="alert alert-<?= $_SESSION['res_type']; ?> alert-dismissible text-center">
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				  <b><?= $_SESSION['response'];?></b>
				</div>
			<?php } unset($_SESSION['response']);?>
			</div>
		</div>	
	</div>

	<div class="row mt-2 ml-1">
		<div class="col-md-4">
			<h3 class="text-center text-info">Введите данные клиента:</h3>
			<form action="operations/actionClient.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<input type="text" name="surname" class="form-control" placeholder="Введите фамилию" required>
				</div>
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Введите имя" required>
				</div>
				<div class="form-group">
					<input type="text" name="middle-name" class="form-control" placeholder="Введите отчество" required>
				</div>
				<div class="form-group">
					<input type="text" name="passport-id" class="form-control" placeholder="Введите номер паспорта" required>
				</div>
				<div class="form-group">
					<input type="text" name="passport-series" class="form-control" placeholder="Введите серию паспорта" required>
				</div>
				<div class="form-group">
					<input type="text" name="passport-issue" class="form-control" placeholder="Введите дату выдачи в формате YYYY-MM-DD" required>
				</div>
				<div class="form-group">
					<input type="submit" name="add" class="btn btn-info btn-block " value="Добавить в таблицу">
				</div>				
			</form>
		</div>
	
	<!-- Table -->
		<div class="col-md-8">		
			<div class="container">         
			  <table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Код</th>
			        <th>Фамилия</th>
			        <th>Имя</th>
			        <th>Отчество</th>
			        <th>Номер паспорта</th>
			        <th>Серия паспорта</th>
			        <th>Дата выдачи</th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>	      
			    		<?php 
							$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
							$mysqli->query("SET NAMES 'utf8'");

							$result = $mysqli->query("SELECT * FROM `clients` ORDER BY `ID` ASC");
							if($result)
							{
								$rows = mysqli_num_rows($result);

								for($i = 0; $i < $rows; ++$i)
								{
									$row = mysqli_fetch_row($result);
									echo"<tr>";
										for ($j = 0 ; $j < 7; ++$j) 
											echo "<td>$row[$j]</td>";
									echo "<td>";?>
									<a href="operations/editClient.php?edit=<?= $row[0]; ?>" class="badge badge-success p-2">Изменить</a>
									<a href="operations/actionClient.php?delete=<?= $row[0]; ?>" onclick="return confirm('Вы действительно хотите удалить эту запись?');" class="badge badge-danger p-2">Удалить</a>
									<?echo "</td>";
									echo"<tr>";
								}								
							}
							mysqli_free_result($result);
							$mysqli->close();
					 	?>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>
</body>
</html>