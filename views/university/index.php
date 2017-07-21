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
    <?php foreach ($listUniver as $listItem):?>
        <tr>
            <td>
                <input type ="text" size="3" readonly value ="<?php echo $listItem['idUniver'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" readonly value ="<?php echo $listItem['nameUniver'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" value ="<?php echo $listItem['cityUniver'] ;?>">
            </td>
            <td>
                <input type ="text" size="32" value="<?php echo $listItem['siteUniver'] ;?>">
            </td>
            <td>
                <a href="/university/open/<?php echo $listItem['idUniver'] ;?>">Відкрити  </a>
                <a href="/university/delete/<?php echo $listItem['idUniver'] ;?>">  Видалити</a>
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
                <input type ="text" size="'32" name = "nameUniver">
            </td>
            <td>
                <input type ="text" size="32" name = "cityUniver">
            </td>
            <td>
                <input type ="text" size="32" name ="siteUniver">
            </td>
            <td>
                <input type="submit" name="submit" value="Ок">
            </td>
        </form>
    </tr>
</table>
</body>
</html>