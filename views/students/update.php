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
    <tr>
        <form action = "/students/open/<?php echo $arrayIdStudent['idStudent'] ;?>" method="post">
            <td>
                <input type ="text" size="3" readonly name = "idStudent" value ="<?php echo $arrayIdStudent['idStudent'] ;?>">
            </td>
            <td>
            <select name ='idChairs'>
                <?php foreach ($arrayListChairs as $listItem):?>
                <option value = '<?php echo $listItem['idChairs'] ;?>'<?php if ($listItem['nameChairs'] === $arrayIdStudent['nameChairs']) echo " selected";?>>
                    <?php echo $listItem['nameChairs'] ;?>
                </option>
                <?php endforeach;?>
            </select>
            </td>
            <td>
                <input type ="text" size="10" name ='firstnameStudent' value ="<?php echo $arrayIdStudent['firstnameStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" name ="lastnameStudent" value ="<?php echo $arrayIdStudent['lastnameStudent'] ;?>">
            </td>
            <td>
                <input type ="text" size="10" name ="numberphoneStudent" value ="<?php echo $arrayIdStudent['numberphoneStudent'] ;?>">
            </td>
            <td>
                <input type="submit" name="update" value="Оновити">
            </td>
        </form>
    </tr>
</table>
</body>
</html>