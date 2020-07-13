	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<link rel="stylesheet" href="../style/style.css"  type="text/css">
		<title>Коммунальное хозяйство</title>
	</head>
	<body>
		<div id="header"><p>Контрольная работа Долговой О.Н. по дисцилине "Доступ к БД"</p>
		</div>
		<div id="navibar"> 
			<form id="form"  action="../index.php" method="get">
				<input id="navi_button" type="submit" name="main" value="Главная">
			</form>
			<form id="form"  action="view_all.php" method="get">
				<input id="navi_button" type="submit" name="persons" value="Просмотр жильцов">
			</form>
			<input id="navi_button" type="submit" name="add_person" value="Добавить жильца">
		</div>

		<div id="main_window">
			<div id="main_window_cont"

				<?php 
				require_once 'connector.php'; // подключаем скрипт

				$connect = mysqli_connect($host, $user, $password , $database);
  					
  				$query = "SELECT * FROM comunal.persons;"; // Выбираем таблицу из которой читать данные
				$result = mysqli_query($connect, $query);
				$rownum = mysqli_num_rows($result);
				printf("<p>Выбрано ".$rownum." жильцов</p>");
				printf("<p>Посмотрим, какие жильцы есть:</p>\n");
				printf("<div id=\"tablespace\">
					<table><tr><th>ID</th>
						<th>Имя</th>
						<th>Фамилия</th>
						<th>№ Дома</th>
						<th>№ Квартиры</th>
						<th>Возраст</th>
						<th>Род занятий</th>
						<th>Комментарий</th>
						<th>Действия</th>
					</tr>");
				while($row = mysqli_fetch_assoc($result)){
  				printf("<tr>
  						<td>".$row['person_id']."</td>
  						<td>".$row['first_name']."</td>
  						<td>".$row['last_name']."</td>
  						<td>".$row['house_no']."</td>
  						<td>".$row['apt_no']."</td>
  						<td>".$row['age']."</td>
  						<td>".$row['job']."</td>
  						<td>".$row['description']."</td>
  						<td>
  							
  								<form id=\"form\"  action=\"mod_person.php\" method=\"get\">
  									<button id=\"action_button\" type=\"submit\" name=\"del_person\" value=\"{$row['person_id']}\">Удалить</button>
  									<button id=\"action_button\" type=\"submit\" name=\"mod_person\" value=\"{$row['person_id']}\">Редакт</button>
  								</form>
  							
  						</td>
  					</tr>
  					");
			  	}
				printf("</table></br>
					<form id=\"form\"  action=\"add_person.php\" method=\"get\">
						<button id=\"action_button\" type=\"submit\" name=\"add_person\" value=\"1\">Добавить жильца</button>
					</form>
					</div>");


			/* очищаем результаты выборки */
			mysqli_free_result($result);
			/* закрываем подключение */
			mysqli_close($connect);  			
			?>

		</div>
	</div>
	</body>
	</html>
