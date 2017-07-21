<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/template/css/style.css" rel="stylesheet" type="text/css" media="screen" />

    <title>Create</title>
</head>
<body>
<a href='/create'>Створити БД   </a>
<a href='/fill'>Заповнити БД.   </a>
<a href='/chairs'>Кафедри.   </a>
<a href='/university'>Університет.   </a>
<a href='/students'>Студенти.   </a><br>
<h1>За запитом <?php echo $_POST['search'] ?> знайдено такі результати:</h1>
<table>
    <?php foreach ($listStudents as $listItem):?>
        <tr>
            <td>
                <input type ="text" size="3" readonly value ="<?php echo $listItem['idStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" value ="<?php echo $listItem['firstnameStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" value ="<?php echo $listItem['lastnameStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" value ="<?php echo $listItem['numberphoneStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" value ="<?php echo $listItem['nameChairs'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" value ="<?php echo $listItem['nameUniver'] ;?>">
            </td>
        </tr>
    <?php endforeach;?>
</table>
</body>
</html>