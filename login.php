<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Подключение к базе данных
$host = 'localhost';
$user = 'root';
$password = 'root';
$database = 'mydatabase';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

// Проверка, была ли отправлена форма авторизации
if (isset($_POST['username']) && isset($_POST['password'])) {
    $log_login = mysqli_real_escape_string($link, $_POST['username']);
    $pass_logi = mysqli_real_escape_string($link, $_POST['password']);

    if (!empty($log_login) && !empty($pass_logi)) {
        // Запрос на получение пользователя с заданным логином и паролем
        $query = "SELECT * FROM `users` WHERE `username` = '{$log_login}' AND `password` = '{$pass_logi}'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    
        // ...
    } else {
        // Если данные пусты, выводим сообщение об ошибке
        echo "<script>alert('Заполните все поля');</script>";
    }
    
    // Запрос на получение пользователя с заданным логином и паролем
    $query = "SELECT * FROM `users` WHERE `username` = '{$log_login}' AND `password` = '{$pass_logi}'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    // Если пользователь найден, то создаем сессию и перенаправляем на главную страницу
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        $_SESSION['success'] = "Вы успешно авторизовались!";
        header('Location: index.php');
        exit();
    } else {
        // Иначе выводим сообщение об ошибке
        echo "<script>alert('Неправильный логин или пароль');</script>";
    }
}

// Закрытие соединения с базой данных
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Авторизация</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/login.css">
    <!--Stylesheet-->
    <style media="screen">
    </style>
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="login.php">
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Username" id="username" name="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <button type="submit">Log In</button>
    </form>
</body>

</html>