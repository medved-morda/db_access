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
			<input id="navi_button" type="submit" name="button1" value="button1"><br/>
			<input id="navi_button" type="submit" name="button2" value="button2"><br/>
			<input id="navi_button" type="submit" name="button3" value="button3"><br/>
		</div>

		<div id="main_window">
			<?php 
			$author = trim($_REQUEST['author']);
			printf("<p>Добрый вечерочек, ".$author."</p><br/>");
			require_once 'connector.php'; // Подключает файл с логином/паролем и именем БД	
			printf("<p>".$host." ".$user." ".$password." ".$database."<br/>");
			$connect = mysqli_connect($host, $user, $password , $database);
  					
  			$query = "SELECT 'HELLO' as word FROM DUAL;"; // Выбираем таблицу из которой читать данные
			$result = mysqli_query($connect, $query);
			$rownum = mysqli_num_rows($result);
			printf("<p>Got ".$rownum."rows<p/>");
			$row = mysqli_fetch_assoc($result);
			printf("<p>".$row['word']."</p><br/>");
			mysqli_free_result($result);

			$sql_select = "SELECT id, name, date FROM learn.test;"; // Выбираем таблицу из которой читать данные
			$result = mysqli_query($connect, $sql_select); // Запрос к БД
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			printf("<p>Посмотрим, какие парни есть:</p><br/>");
			while($row = mysqli_fetch_assoc($result)){
  			printf("<p>Парень № ".$row['id'].". По имени: ".$row['name'].". Возрастом: ".$row['date'] 
  				."</p>----------------------------------------<b>");
			  }

			/* очищаем результаты выборки */
			mysqli_free_result($result);
			/* закрываем подключение */
			mysqli_close($connect);  			
			?>

		</div>
	</body>
	</html>
