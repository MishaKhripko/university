<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="/template/css/style.css" rel="stylesheet" type="text/css" media="screen" />

    <title>Create</title>
</head>
<body>
<h1><a href='/create'>Створити БД   </a><a href='/fill'>Заповнити БД.   </a><a href='/chairs'>Кафедри</a></h1><br>
<h1>Список Кафедр</h1>
<table>
    <?php foreach ($listChairs as $listItem):?>
        <tr>
            <td>
                <input type ="text" size="3" readonly value ="<?php echo $listItem['idChairs'] ;?>">
            </td>
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
</table>
</body>
</html>