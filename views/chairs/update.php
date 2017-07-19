<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link href="/template/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
	<title>Create</title>
</head>
<body>
<h1><a href='/create'>Створити БД </a><a href='/fill'>Заповнити БД. </a><a href='/chairs'>Кафедри</a></h1><br>
<h1>Список Кафедр</h1>
<table>
	<tr>
		<form action="" method="post">
			<td>
				<input type="text" size="3" readonly name="idChairs" value="<?php echo $arrayidChairs['idChairs']; ?>">
			</td>
			</td>
			<td>
				<input type="text" size="32" readonly value="<?php echo $arrayidChairs['nameUniver']; ?>">
			</td>
			<td>
				<input type="text" size="32" name="nameChairs" value="<?php echo $arrayidChairs['nameChairs']; ?>">
			</td>
			<td>
				<input type="submit" name="update" value="Оновити">
				<input type="submit" name="delete" value="Видалити">
			</td>
		</form>
	</tr>
</table>
</body>
</html>