<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Проверка на пустые поля
	if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
		echo "<script>alert('Заполните все поля');</script>";
		exit;
	}

	// Проверка корректности email
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo "<script>alert('Некорректный адрес email');</script>";
		exit;
	}

	// Подключение к базе данных
	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$database = 'mydatabase';

	$link = mysqli_connect($host, $user, $password, $database)
		or die("Ошибка " . mysqli_error($link));

	// Получение данных из формы
	$username_reg = mysqli_real_escape_string($link, $_POST['username']);
	$email_reg = mysqli_real_escape_string($link, $_POST['email']);
	$password = mysqli_real_escape_string($link, $_POST['password']);

	// Хеширование пароля
	//$password_hash = password_hash($password, PASSWORD_DEFAULT);

	// Добавление пользователя в базу данных
	if (!empty($username_reg) && !empty($email_reg) && !empty($password)) {
		$query = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username_reg', '$email_reg', '$password')";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		mysqli_close($link);

		// Создание сессии и перенаправление на главную страницу
		$_SESSION['username'] = $username_reg;
		header('Location: index.php?registration=success');
		exit;
	} else {
		echo "<script>alert('Поля не должны быть пустыми');</script>";
	}

	// Закрытие соединения с базой данных
	mysqli_close($link);

	echo "<script>alert('Регистрация прошла успешно');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Design by foolishdeveloper.com -->
	<title>Регистрация</title>

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="styles/registration.css">
	<!--Stylesheet-->
</head>
<style media="screen">
</style>

<body>
	<div class="background">
		<div class="shape"></div>
		<div class="shape"></div>
	</div>
	<form method="post" action="register.php">
		<h3>Registration Here</h3>
		<!--<h4>После успешной авторизации будет мгновенное перенаправление на главную страницу</h4>-->

		<label for="username">Username</label>
		<input type="text" placeholder="Username" name="username" id="username">

		<label for="email">Email</label>
		<input type="email" placeholder="email" name="email" id="email">

		<label for="password">Password</label>
		<input type="password" placeholder="Password" name="password" id="password">
		<button type="submit">Registration</button>
	</form>
</body>

</html>