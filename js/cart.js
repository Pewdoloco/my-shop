
var cart = [];

function addToCart(productId) {
  cart.push(productId);
  renderCart();
}

function getProductById(product_id) {
  var product = {};
  $.ajax({
    url: 'get_product_by_id.php',
    type: 'GET',
    data: {
      id: product_id
    },
    async: false,
    dataType: 'json',
    success: function (data) {
      product.name = data.name;
      product.price = data.price; // Добавлено свойство price
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('Ошибка получения данных о продукте!');
      console.error(errorThrown);
    }
  });
  return product;
}


const totalEl = document.querySelector(".cart-total");

function renderCart() {
  var cartList = document.getElementById("cart-list");
  var cartItems = {}; // объект для хранения количества каждого товара
  var total = 0; // переменная для хранения общей стоимости товаров в корзине

  // считаем количество каждого товара в корзине
  for (var i = 0; i < cart.length; i++) {
    var productId = cart[i];
    if (cartItems[productId]) {
      cartItems[productId]++;
    } else {
      cartItems[productId] = 1;
    }
  }

  cartList.innerHTML = "";

  // выводим список товаров в корзине и собираем строку с итоговыми данными
  for (var productId in cartItems) {
    var quantity = cartItems[productId];
    var product = getProductById(productId);

    var li = document.createElement("li");
    li.classList.add("cart-item");

    var nameEl = document.createElement("div");
    nameEl.classList.add("cart-item-name");

    if (product.name) {
      nameEl.innerText = product.name;
    } else {
      nameEl.innerText = "Ошибка получения данных о продукте!";
    }
    li.appendChild(nameEl);

    var quantityEl = document.createElement("div");
    quantityEl.classList.add("cart-item-quantity");
    quantityEl.innerText = quantity;
    li.appendChild(quantityEl);

    var deleteButton = document.createElement("button");
    deleteButton.classList.add("delete-button");
    deleteButton.innerText = "Удалить товар";
    deleteButton.setAttribute("data-index", i);
    deleteButton.onclick = function() {
      var index = this.getAttribute("data-index");
      cart.splice(index, 1);
      renderCart();
    };
    li.appendChild(deleteButton);

    cartList.appendChild(li);

    total += quantity * product.price; // увеличиваем общую стоимость на стоимость текущего товара
  }

  if (!totalEl) {
    totalEl = document.createElement("p");
    totalEl.classList.add("cart-total");
    document.querySelector(".korzina").insertBefore(totalEl, document.querySelector(".form"));
  }
  totalEl.innerText = `Итого: ${total} руб.`;
}


function checkout() {
  if (cart.length > 0 && isAuthenticated()) {
    alert("Заказ оформлен: " + cart.join(", "));
    cart = [];
    renderCart();
  } else if (cart.length == 0) {
    alert("Корзина пуста!");
  } else {
    alert("Для оформления заказа необходимо авторизоваться!");
  }
}

function isAuthenticated() {
  // здесь должна быть проверка авторизации пользователя
  // возвращаем true, если пользователь авторизован, и false, если нет
  return true;
}
