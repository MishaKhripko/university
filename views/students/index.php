<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/template/css/style.css" rel="stylesheet" type="text/css" media="screen" />

    <title>Create</title>
</head>
<body>
<h1><a href='/create'>Створити БД   </a><a href='/fill'>Заповнити БД.   </a><a href='/chairs'>Кафедри</a></h1><br>
<h1>Список Студентів</h1>
<table>
    <?php foreach ($listStudents as $listItem):?>
        <tr>
            <td>
                <input type ="text" size="3" readonly value ="<?php echo $listItem['idStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" readonly value ="<?php echo $listItem['firstnameStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" value ="<?php echo $listItem['lastnameStudent'] ;?>">
            </td>
            <td>
                <a href="/students/open/<?php echo $listItem['idStudent'] ;?>">Відкрити  </a>
                <a href="/students/delete/<?php echo $listItem['idStudent'] ;?>">  Видалити</a>
            </td>
        </tr>
    <?php endforeach;?>
    <!--<tr>
        <form action="" method="post">
            <td>
                <span>
                    Додати:
                </span>
            </td>
            <td>
                <select name = "idUniver">
                    <?php $i=0; foreach ($listStudents as $listItem):?>
                        <option value="<?php echo $listItem['idUniver'] ;?>">
                            <?php echo $listItem['nameUniver'] ;?>
                        </option>
                        <?php $i++; endforeach;?>
                </select>
            </td>
            <td>
                <input type ="text" size="32" name = "nameChairs">
            </td>
            <td>
                <input type="submit" value="Додати кафедру">
            </td>
        </form>
    </tr>
    -->
</table>
</body>
</html>