	<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html">
		<link rel="stylesheet" href="../style/style.css"  type="text/css">
		<title>Коммунальное хозяйство</title>
	</head>
	<body>
		<div id="header"><p>Контрольная работа Долговой О.Н. по дисцилине "Доступ к БД"</p></div>

		<div id="navibar"> 
			<form id="form"  action="../index.php" method="get">
				<input id="navi_button" type="submit" name="main" value="Главная">
			</form>
			<form id="form"  action="view_all.php" method="get">
				<input id="navi_button" type="submit" name="persons" value="Просмотр жильцов">
			</form>
			<input id="navi_button" type="submit" name="add_person" value="Добавить жильца"><br/>
		</div>
		
		<div id="main_window">
			<div id="main_window_cont"

			<?php	
				require_once 'connector.php'; // Подключает файл с логином/паролем и именем БД	

			 	$connect = mysqli_connect($host, $user, $password , $database);
			if (mysqli_connect_errno()) {
    			printf("<p>Не удалось подключиться: %s\n".mysqli_connect_error()."</p>");
   			 exit();
   			 }



			 if (!empty($_GET["add_person"])) {
			 	printf("
			 			<table>
			 			<form method=\"get\" action=\"add_person.php\">Заполняем поля для передачи информации:<br><br>

 							<tr><td><p>Имя: </p></td><td><input name=\"first_name\" type=\"text\" maxlength=\"20\" size=\"25\" required></td></tr></br>
 							<tr><td><p>Фамилия:</p></td><td> <input name=\"last_name\" type=\"text\" maxlength=\"20\" size=\"25\" required></td></tr></br>
 							<tr><td><p>Номер дома:</p></td><td> <input name=\"house_no\" type=\"number\" maxlength=\"20\" size=\"25\" required></td></tr></br>
 							<tr><td><p>Номер квартиры:</p></td><td> <input name=\"apt_no\" type=\"number\" maxlength=\"20\" size=\"25\" required></td></tr></br>
 							<tr><td><p>Возраст:</p></td><td> <input name=\"age\" type=\"number\" maxlength=\"20\" size=\"25\" required></td></tr></br>
 							<tr><td><p>Работа:</p></td><td> <input name=\"job\" type=\"text\" maxlength=\"20\" size=\"25\"></td></tr></br>
 							<tr><td><p>Комментарии:</p></td><td> <input name=\"desc\" type=\"text\" maxlength=\"50\" size=\"25\"></td></tr></br>
						</table>
						<br><br> <input type=\"submit\" value=\"Добавить\">
						</form>");
			 }elseif (!empty($_GET["first_name"])) {

			 	$first_name = $_GET['first_name'];
			 	$last_name  = $_GET['last_name'];
			 	$house_no 	= $_GET['house_no'];
			 	$apt_no 	= $_GET['apt_no'];
			 	$age 	 	= $_GET['age'];
			 	$job 		= $_GET['job'];
			 	$desc 		= $_GET['desc'];

				$query = "INSERT INTO comunal.persons VALUES (null, '$first_name', '$last_name', $house_no, NULLIF($apt_no,''), NULLIF($age,''), NULLIF('$job',''), NULLIF('$desc',''));";
				// printf("<p>".$query."</p><br>");
				$result = mysqli_query($connect, $query);

				if (!$result) {
    				printf("<p>Invalid query: ".mysqli_error($connect)."</p>");
				} else  {
					printf("<br><p>Новый житель добавлен успешно!</p>");
				}

			 }

			/* очищаем результаты выборки */
			//mysqli_free_result($result);

			/* закрываем подключение */
			mysqli_close($connect);  			
			?>

		</div>
	</div>
	</body>
	</html>