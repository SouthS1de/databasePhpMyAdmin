<!DOCTYPE html>
<html>
<head>
	<title>Ломбард</title>
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
	<div class="container">
	  <h2>Список запросов:</h2>
	  <p>Нажмите на кнопку, чтобы вывести запрос.</p>
	  <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#query1">Товары со скидкой.</button>
		<div id ="query1" class="collapse">	        
		<?php 
			$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
			$mysqli->query("SET NAMES 'utf8'");

			$result = $mysqli->query("SELECT * FROM `categories` WHERE  `note` LIKE  '%скидка%' ORDER BY `ID` ASC ");
			if($result)
			{
				$rows = mysqli_num_rows($result);
				if($rows != 0)
				{
				?>		<div class="col-md-8">		
						<div class="container">         
						  <table class="table table-hover">
							<thead>
							  <tr>
								<th>Код</th>
								<th>Название</th>
								<th>Примечание</th>
							  </tr>
							</thead>
							<tbody>	<?
					
					for($i = 0; $i < $rows; ++$i)
					{
						$row = mysqli_fetch_row($result);
						echo"<tr>";
							for ($j = 0 ; $j < 3; ++$j) 
								echo "<td>$row[$j]</td>";
						echo "<td>";?>
						<a href="operations/editCategories.php?edit=<?= $row[0]; ?>" class="badge badge-success p-2">Изменить</a>
						<a href="operations/actionCategories.php?delete=<?= $row[0]; ?>" onclick="return confirm('Вы действительно хотите удалить эту запись?');" class="badge badge-danger p-2 ml-2">Удалить</a>
						<?echo "</td>";
						echo"<tr>";
					}?>
							</tbody>
						  </table>
						</div>
					</div><?
				}
				else
					echo "Записи по этому запросу отсутствуют!";
			}

			mysqli_free_result($result);
			$mysqli->close();?>
	  </div>
	  <br><br>
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#query2">Клиенты с фамилией на "Еф...".</button>
			<div id="query2" class="collapse">     
			<?php 
				$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
				$mysqli->query("SET NAMES 'utf8'");

				$result = $mysqli->query("SELECT * FROM `clients` WHERE  `surname` LIKE  'Еф%' ORDER BY  `clients`.`ID` ASC ");
				if($result)
				{
					$rows = mysqli_num_rows($result);
					if($rows != 0)
					{
					?><div class="col-md-8">		
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
							  </tr>
							</thead>
							<tbody>	 <?
						
						for($i = 0; $i < $rows; ++$i)
						{
							$row = mysqli_fetch_row($result);
							echo"<tr>";
								for ($j = 0 ; $j < 7; ++$j) 
									echo "<td>$row[$j]</td>";
							echo "<td>";?>
							<a href="operations/editClient.php?edit=<?= $row[0]; ?>" class="badge badge-success p-2">Изменить</a>
							<a href="operations/actionClient.php?delete=<?= $row[0]; ?>" onclick="return confirm('Вы действительно хотите удалить эту запись?');" class="badge badge-danger p-2 ml-2">Удалить</a>
							<?echo "</td>";
							echo"<tr>";
						}?>
								</tbody>
							  </table>
							</div>
						</div><?
					}
					else
						echo "Записи по этому запросу отсутствуют!";
				}
				mysqli_free_result($result);
				$mysqli->close();
			?>
		</div>
		<br><br>
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#query3">Сдачи без возможности возврата.</button>
			<div id="query3" class="collapse">      
			<?php 
				$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
				$mysqli->query("SET NAMES 'utf8'");
				
				$today = date("y-m-d");
				
				$result = $mysqli->query("SELECT * FROM `dropto` WHERE  `date_undo` <=  '$today' ORDER BY `ID` ASC ");
				if($result)
				{
					$rows = mysqli_num_rows($result);
					if($rows != 0)
					{
					?><div class='col-md-8'>		
						<div class='container'>         
						  <table class='table table-hover'>
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
							<tbody><?
						
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
						}?>
								</tbody>
							  </table>
							</div>
						</div><?
					}
					else
						echo "Записи по этому запросу отсутствуют!";
				}
								mysqli_free_result($result);
								$mysqli->close();?>
		</div>
		<br><br>
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#query4">Сдачи за 2018 год.</button>
			<div id="query4" class="collapse">      
			<?php 
				$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
				$mysqli->query("SET NAMES 'utf8'");
				
				$result = $mysqli->query("SELECT * FROM  `dropto` WHERE  `date_to` <=  '2018-12-31' AND  `date_to` >=  '2018-01-01' ORDER BY  `dropto`.`ID` ASC");
				if($result)
				{
					$rows = mysqli_num_rows($result);
					if($rows != 0)
					{
					?><div class='col-md-8'>		
						<div class='container'>         
						  <table class='table table-hover'>
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
							<tbody><?
						
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
						}?>
								</tbody>
							  </table>
							</div>
						</div><?
					}
					else
						echo "Записи по этому запросу отсутствуют!";
				}
				mysqli_free_result($result);
				$mysqli->close();
			?>
		</div>
		<br><br>
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#query5">Все сдачи за этот месяц, дороже 5000грн.</button>
			<div id="query5" class="collapse">
			<?php 
				$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
				$mysqli->query("SET NAMES 'utf8'");
				$today = date("y-m-d");
				$first_day = date("y-m-01");
				
				$result = $mysqli->query("SELECT * FROM `dropto` WHERE  `date_to` <=  '$today' AND `date_to` >=  '$first_day' AND `summ` >= '5000' ORDER BY `ID` ASC ");
				if($result)
				{
					$rows = mysqli_num_rows($result);
					if($rows != 0)
					{
					?><div class='col-md-8'>		
						<div class='container'>         
						  <table class='table table-hover'>
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
							<tbody><?
						
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
						}?>
								</tbody>
							  </table>
							</div>
						</div><?
					}
					else
						echo "Записи по этому запросу отсутствуют!";
				}
				mysqli_free_result($result);
				$mysqli->close();
			?>
		</div>
		<br><br>
		<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#query6">Клиенты, просрочившие возврат денег.</button>
			<div id="query6" class="collapse">      
			<?php 
				$mysqli = new mysqli("localhost", "root", "", "pawnshopbase");
				$mysqli->query("SET NAMES 'utf8'");
				
				$today = date("y-m-d");
				
				$query ="SELECT * FROM `dropto` WHERE  `date_undo` <=  '$today' ORDER BY `ID` ASC ";
				$ids = array();
				if($result = $mysqli->query($query))
				{
					while($row = $result->fetch_row())
					{
						$ids[] = $row[1];
					}									
				}
				mysqli_free_result($result);
				if($ids != 0)
				{?>
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
						  </tr>
						</thead>
						<tbody><?	
					foreach($ids as &$i)
					{
						$result = $mysqli->query("SELECT * FROM  `clients` WHERE `ID` = '$i' ORDER BY `ID` ASC");
						if($result)
						{
							$row = mysqli_fetch_row($result);
							echo"<tr>";
							for ($j = 0 ; $j < 7; ++$j) 
								echo "<td>$row[$j]</td>";
							echo "<td>";?>
							<a href="operations/editClient.php?edit=<?= $row[0]; ?>" class="badge badge-success p-2">Изменить</a>
							<a href="operations/actionClient.php?delete=<?= $row[0]; ?>" onclick="return confirm('Вы действительно хотите удалить эту запись?');" class="badge badge-danger p-2 ml-2">Удалить</a>
							<?echo "</td>";
							echo"<tr>";
						}
					}
					mysqli_free_result($result);?>
						</tbody>
					  </table>
					</div>
				</div><?
				}
				else
					echo "Записи по этому запросу отсутствуют!";								
				$mysqli->close();
			?>
		</div>
</body>
</html>
