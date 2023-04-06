<?php
session_start();

if (isset($_SESSION['success'])) {
    echo "<p>{$_SESSION['success']}</p>";
    echo "<form action='logout.php' method='POST' class='form-logout'>";
    echo "<button type='submit' class='logout-btn'>Выйти из аккаунта</button>";
    echo "</form>";
} else {
    echo "<a href='register.php' class='register-btn'>Зарегистрироваться</a>";
    echo "<a href='login.php' class='login-btn'>Войти</a>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Абсолютли Фром Алэксандр Невски</title>
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
    <!--
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/header.css">
    -->
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="style/product.css">
    <link rel="stylesheet" href="style/auth.css">
    <link rel="stylesheet" href="style/footer.css">

   
</head>

<body>
    <header>
        <div class="logotip" style="width: 100%;">
            <div style="width: 50%; margin: 0 auto;">
                <img style="display: block; margin-left: auto; margin-right: auto" src="image/logo.png">
            </div>
        </div>
        <h1>Wonderbar</h1>
    </header>
    <main style=" display: flex; flex-direction: row-reverse; justify-content: space-around;">

        <div class="cart-sect">
            <div class="korzina">
                <h2>Корзина</h2>
                <ul id="cart-list"></ul>
                <?php if (isset($_SESSION['success'])) : ?>
                    <button type="button" class="order-btn" onclick="checkout()">Оформить заказ</button>
                <?php else : ?>
                    <button type="button" class="order-btn" disabled>Оформить заказ</button>
                <?php endif; ?>

            </div>
        </div>

        <div class="main-sect">
            <?php
            // Подключение к базе данных
            $host = 'localhost';
            $user = 'root';
            $password = 'root';
            $database = 'mydatabase';

            $link = mysqli_connect($host, $user, $password, $database)
                or die("Ошибка " . mysqli_error($link));

            // Запрос на получение списка товаров
            $query = "SELECT * FROM `products`";
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

            // Вывод списка товаров
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='wrapper'>";
                echo "<div class='product-img'>";
                echo "<img src='{$row['image']}' height='420' width='327'>";
                echo "</div>";
                echo "<div class='product-info'>";
                echo "<div class='product-text'>";
                echo "<h1>{$row['name']}</h1>";
                echo "<p>{$row['description']}</p>";
                echo "</div>";
                echo "<div class='product-price-btn'>";
                echo "<p><span>{$row['price']}</span>$</p>";
                echo "<button type='button' id='{$row['id']}' onclick='addToCart({$row['id']})'>buy now</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            mysqli_close($link);
            ?>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">affiliate program</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">order status</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="#">буянов</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/cart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>