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


			 if (!empty($_GET["del_person"])) {
			 	$p_id = $_GET["del_person"];
			 	$query = "DELETE FROM comunal.persons WHERE person_id = $p_id;";
			 	$result = mysqli_query($connect, $query);

			 	if (!$result) {
    				printf("<p>Invalid query: ".mysqli_error($connect)."</p>");
				} else  {
					printf("<br><p>Житель удален из базы!</p>");
				}
							 			/* очищаем результаты выборки */
				mysqli_free_result($result);

			 }elseif (!empty($_GET["mod_person"])) {

			 	$p_id = $_GET["mod_person"];
			 	$query = "SELECT * FROM comunal.persons WHERE person_id = $p_id;";
			 	$result = mysqli_query($connect, $query);
				$row = mysqli_fetch_assoc($result);

			 		if (!$result) {
    					printf("<p>Invalid query: ".mysqli_error($connect)."</p>");
					}else{

			 		printf("
			 			<p>Редактирование жителя: </p><br><br>
			 		<form action=\"mod_person.php\" method=\"get\">

			 					<label for \"person_id\">ID: </label></br>
			 					<input name=\"person_id\" type=\"text\" maxlength=\"20\" size=\"10\" value=\"".$row['person_id']."\" readonly></br></br>

			 					<label for \"first_name\">Имя: </label></br>
			 					<input name=\"first_name\" type=\"text\" maxlength=\"20\" size=\"10\" value=\"".$row['first_name']."\" required></br></br>

			 					<label for \"last_name\">Фамилия: </label></br>
			 					<input name=\"last_name\" type=\"text\" maxlength=\"20\" size=\"10\" value=\"".$row['last_name']."\" required></br></br>

			 					<label for \"house_no\">№ дома: </label></br>
			 					<input name=\"house_no\" type=\"number\" maxlength=\"20\" size=\"10\" value=\"".$row['house_no']."\" required></br></br>

			 					<label for \"apt_no\">№ квартиры: </label></br>
			 					<input name=\"apt_no\" type=\"text\" maxlength=\"20\" size=\"10\" value=\"".$row['apt_no']."\" required></br></br>

			 					<label for \"age\">Возраст: </label></br>
			 					<input name=\"age\" type=\"text\" maxlength=\"20\" size=\"10\" value=\"".$row['age']."\" required></br></br>

			 					<label for \"job\">Работа: </label></br>
			 					<input name=\"job\" type=\"text\" maxlength=\"20\" size=\"10\" value=\"".$row['job']."\"></br></br>

			 					<label for \"description\">Комментарий: </label></br>
			 					<input name=\"description\" type=\"text\" maxlength=\"20\" value=\"".$row['description']."\"></br></br>
			 					
			 					<input type=\"submit\" value=\"Применить\">
			 		</form>
			 		");
			 	}

			 }elseif(!empty($_GET["first_name"])){

			 	$person_id 	= $_GET['person_id'];
			 	$first_name = $_GET['first_name'];
			 	$last_name  = $_GET['last_name'];
			 	$house_no 	= $_GET['house_no'];
			 	$apt_no 	= $_GET['apt_no'];
			 	$age 	 	= $_GET['age'];
			 	$job 		= $_GET['job'];
			 	$desc 		= $_GET['description'];


				$query = "UPDATE comunal.persons SET first_name = '$first_name', last_name = '$last_name', house_no = $house_no, apt_no = $apt_no, age = $age, job = '$job', description = '$desc' WHERE person_id = $person_id;";
							 					 // printf("<p>".$query."</p><br>");

				$result = mysqli_query($connect, $query);

				if (!$result) {
    				printf("<p>Invalid query: ".mysqli_error($connect)."</p>");
				} else  {
					printf("<br><br><p>Новый житель отредактирован успешно!</p>");
				}

			 }
			 			/* очищаем результаты выборки */
			mysqli_free_result($result);
			mysqli_close($connect);		
			?>

		</div>
	</div>
	</body>
	</html>
