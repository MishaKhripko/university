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
<h1>Список Кафедр</h1>
<table>
    <?php foreach ($listChairs as $listItem):?>
        <tr>
            <td>
                <input type ="text" size="3" readonly value ="<?php echo $listItem['idChairs'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" readonly value ="<?php echo $listItem['nameUniver'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" value ="<?php echo $listItem['nameChairs'] ;?>">
            </td>
            <td>
                <a href="/chairs/open/<?php echo $listItem['idChairs'] ;?>">Відкрити  </a>
                <a href="/chairs/delete/<?php echo $listItem['idChairs'] ;?>">  Видалити</a>
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
                <select name = "idUniver">
                    <?php $i=0; foreach ($listUniversities as $listItem):?>
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
</table>
</body>
</html>