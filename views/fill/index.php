<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Create</title>
</head>
<body>

<a href='/create'>Створити БД   </a>
<a href='/fill'>Заповнити БД.   </a>
<a href='/chairs'>Кафедри.   </a>
<a href='/university'>Університет.   </a>
<a href='/students'>Студенти.   </a><br>
<br>
<p>
    <?php if ($this->record !== NULL){
        echo "База даних Заповнена!";
        echo '<table>';
        foreach ($this->record as $key => $value){
            echo "<tr>"."<td>Таблиця $key</td>"."<td>Заповнена на $value записів</td>"."</tr>";
        }
        echo '</table>';




    } else {
        echo "Неможливо створити нову БД, так як існує стара версія.Виникла помилка при заповненні БД";
    }
    ?>
</p>
</body>
</html>