<!DOCTYPE html>
<html>
<head>
	<title>Сдача в ломбард</title>
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
				<h3 class="text-center text-dark mt-2">Таблица сдач в ломбард</h3>
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
			<h3 class="text-center text-info">Введите данные сдачи в ломбард:</h3>
			<form action="operations/actionLease.php" method="post" enctype="multipart/form-data">				
				<div class="form-group">
					<select name="client-id" class="custom-select">
					<option selected>Выберите код клиента</option>
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
									echo "<option value='$row[0]'>$row[0] $row[1] $row[2] $row[3]</option>";
								}								
							}
							mysqli_free_result($result);
							$mysqli->close();
					 	?>
					</select>
				</div>
				<div class="form-group">
					<select name="product-id" class="custom-select">
					<option selected>Выберите код товара</option>
					<?php 
							$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
							$mysqli->query("SET NAMES 'utf8'");

							$result = $mysqli->query("SELECT * FROM `categories` ORDER BY `ID` ASC");
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
							$mysqli->close();
					 	?>
					</select>
				</div>
				<div class="form-group">
					<input type="text" name="about" class="form-control" placeholder="Введите описание товара" required>
				</div>
				<div class="form-group">
					<input type="text" name="date-to" class="form-control" placeholder="Введите дату сдачи в формате YYYY-MM-DD" required>
				</div>
				<div class="form-group">
					<input type="text" name="date-undo" class="form-control" placeholder="Введите дату возврата в формате YYYY-MM-DD" required>
				</div>
				<div class="form-group">
					<input type="text" name="sum" class="form-control" placeholder="Введите сумму" required>
				</div>
				<div class="form-group">
					<input type="text" name="comission" class="form-control" placeholder="Введите комиссионные" required>
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
			        <th>Код клиента</th>
			        <th>Код товара</th>
			        <th>Описание товара</th>
			        <th>Дата сдачи товара</th>
			        <th>Действительно до</th>
			        <th>Сумма</th>
			        <th>Комиссионные</th>
			      </tr>
			    </thead>
			    <tbody>	      
			    		<?php 
							$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
							$mysqli->query("SET NAMES 'utf8'");

							$result = $mysqli->query("SELECT * FROM `dropto` ORDER BY `ID` ASC");
							if($result)
							{
								$rows = mysqli_num_rows($result);

								for($i = 0; $i < $rows; ++$i)
								{
									$row = mysqli_fetch_row($result);
									echo"<tr>";
										for ($j = 0 ; $j < 8; ++$j) 
											echo "<td>$row[$j]</td>";
									echo "<td>";?>
									<a href="operations/editLease.php?edit=<?= $row[0]; ?>" class="badge badge-success p-2">Изменить</a>
									<a href="operations/actionLease.php?delete=<?= $row[0]; ?>" onclick="return confirm('Вы действительно хотите удалить эту запись?');" class="badge badge-danger p-2 ml-2">Удалить</a>
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