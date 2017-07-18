<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Create</title>
</head>
<body>
<h1>Create database</h1>
    <p>
        <?php if ($result == 1){
        echo "База даних створена!";
    } else {
        echo "Неможливо створити нову БД, так як існує стара версія.";
    }
    ?>
</p>
</body>
</html>