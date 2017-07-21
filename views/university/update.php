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
<br>
<h1>Список Університетів</h1>
<table>
    <tr>
        <form action = "" method="post">
            <td>
                <input type ="text" size="3" readonly = "idUniver" value ="<?php echo $arrayGetRow['idUniver'] ;?>">
            <td>
                <input type ="text" size="32" name = "nameUniver" value ="<?php echo $arrayGetRow['nameUniver'] ;?>">
            </td>
            </td>
            <td>
                <input type ="text" size="32" name="cityUniver" value ="<?php echo $arrayGetRow['cityUniver'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" name ="siteUniver" value ="<?php echo $arrayGetRow['siteUniver'] ;?>">
            </td>
            <td>
                <input type="submit" name="update" value="Оновити">
            </td>
        </form>
    </tr>
</table>
</body>
</html>