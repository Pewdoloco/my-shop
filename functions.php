<?php
function showProducts() {
    global $link;
    
    // Запрос на получение списка товаров
    $query = "SELECT * FROM `products`";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    // Вывод списка товаров
    echo "<table>";
    $count = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($count % 4 == 0) {
            echo "<tr>";
        }

        echo "<td>";
        echo "<img src='{$row['image']}' alt='{$row['name']}'>";
        echo "<h2>{$row['name']}</h2>";
        echo "<p>{$row['description']}</p>";
        echo "<p>{$row['price']} руб.</p>";
        echo "<button onclick='addToCart({$row['id']})'>Добавить в корзину</button>";
        echo "</td>";

        if ($count % 4 == 3) {
            echo "</tr>";
        }
        $count++;
    }
    echo "</table>";
}
?>