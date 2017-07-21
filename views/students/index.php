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
<h1>Список Студентів</h1>
<table>
    <form action = "" method="post">
        <tr>
            <td colspan="5">
                <input type="text" size="80" name="search">
            </td>
            <td>
                <input type="submit" value = "Пошук">
            </td>
        </tr>
    </form>
    <?php foreach ($listStudents as $listItem):?>
        <tr>
            <td>
                <input type ="text" size="3" readonly value ="<?php echo $listItem['idStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="25" value ="<?php echo $listItem['nameChairs'] ;?>">
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
                <a href="/students/open/<?php echo $listItem['idStudent'] ;?>">Відкрити  </a>
                <a href="/students/delete/<?php echo $listItem['idStudent'] ;?>">  Видалити</a>
            </td>
        </tr>
    <?php endforeach;?>
    <tr>
        <form action="" method="post">
            <td>
                <span>
                    Додати:
                </span>
            </td>
            <td>
                <select name ='idChairs'>
                    <?php foreach ($arrayListChairs as $listItem):?>
                        <option value = "<?php echo $listItem['idChairs'] ;?>">
                                <?php echo $listItem['nameChairs'] ;?>
                        </option>
                    <?php endforeach;?>
                </select>
            </td>
            <td>
                <input type ="text" size="10" name = "firstnameStudent">
            </td>
            <td>
                <input type ="text" size="10" name = "lastnameStudent">
            </td>
            <td>
                <input type ="text" size="10" name = "numberphoneStudent">
            </td>
            <td>
                <input type="submit" value="Додати кафедру">
            </td>
        </form>
    </tr>
</table>
</body>
</html>