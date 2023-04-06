<?php
session_start(); // запускаем сессию

// удаляем все переменные сессии
session_unset();

// уничтожаем сессию
session_destroy();

// перенаправляем пользователя на главную страницу сайта
header("Location: /index.php");
exit();
?>
