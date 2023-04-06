
<?php
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'mydatabase';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

$id = $_GET['id']; // параметр запроса
$query = "SELECT `name` FROM `products` WHERE `id` = $id";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$product = mysqli_fetch_assoc($result);

echo json_encode($product); // возвращаем результат в формате JSON

mysqli_close($link);
?>