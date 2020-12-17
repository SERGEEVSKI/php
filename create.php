<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
</head>
<body>
<?php
require_once 'connection.php'; // подключаем скрипт
 
if(isset($_POST['klient_name']) && isset($_POST['book'] && isset($_POST['status'])){
 
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_error($link)); 
     
    $_POST['data'] = current_timestamp();    
     
    // экранирования символов для mysql
    $klient_name = htmlentities(mysqli_real_escape_string($link, $_POST['klient_name']));
    $book = htmlentities(mysqli_real_escape_string($link, $_POST['book']));
    $status = htmlentities(mysqli_real_escape_string($link, $_POST['status']));
    $data = htmlentities(mysqli_real_escape_string($link, $_POST['data']));
     
    // создание строки запроса
    $query ="INSERT INTO lib_orders VALUES(NULL, '$klient_name','$book','$status','$data')";
     
    // выполняем запрос
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
    if($result)
    {
        echo "<span style='color:blue;'>Данные добавлены</span>";
    }
    // закрываем подключение
    mysqli_close($link);
}
?>
<h2>Добавить новый заказ</h2>
<form method="POST">
<p>Введите имя заказчика:<br> 
<input type="text" name="klient_name" /></p>
<p>Книга: <br> 
<input type="text" name="book" /></p>
<p>Статус заявки: <br> 
<input type="text" name="status" /></p>
<input type="submit" value="Добавить">
</form>
</body>
</html>