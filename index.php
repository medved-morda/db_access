
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<link rel="stylesheet" href="style/style.css"  type="text/css">
		<title>Коммунальное хозяйство</title>
	</head>
	<body>
		<div id="header"><p>Контрольная работа Долговой О.Н. по дисцилине "Доступ к БД"</p></div>
		<div id="navibar"> 

			<form id="form"  action="scripts/view_all.php" method="get">
				<input id="navi_button" type="submit" name="persons" value="Просмотр жильцов"></br>
			</form>
			<form id="form"  action="scripts/add_person.php" method="get">
				<input id="navi_button" type="submit" name="add_person" value="Добавить жильца"><br/>
			</form>
		</div>

		<div id="main_window">
			<div id="main_window_cont"
			<?php 
			
			require_once 'connector.php'; // подключаем скрипт

			$connect = mysqli_connect($host, $user, $password , $database);
  					
  			$query = "SELECT h.*, p.* FROM ((select count(1) as house_num, street FROM comunal.houses group by street)h, (select count(1) as  pers_num from comunal.persons)p);"; // Выбираем таблицу из которой читать данные
			$result = mysqli_query($connect, $query);
			$row = mysqli_fetch_assoc($result);
			printf("<p>На улице ".$row['street']." ".$row['house_num']." домов и проживает ".$row['pers_num']." человек.</p>");


			/* очищаем результаты выборки */
			mysqli_free_result($result);
			/* закрываем подключение */
			mysqli_close($connect);  

			?>
		</div>
	</div>
	</body>
</html>
