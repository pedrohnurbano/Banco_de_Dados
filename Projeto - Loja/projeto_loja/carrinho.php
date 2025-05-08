<?php
session_start();
$status = "";

if (isset($_POST['action']) && $_POST['action'] == "remove") {
    if (!empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if (isset($_POST["code"]) && $_POST["code"] == $key) {
                unset($_SESSION["shopping_cart"][$key]);
                $status = "<div class='box error'>Produto removido do carrinho!</div>";
            }
            if (empty($_SESSION["shopping_cart"])) {
                unset($_SESSION["shopping_cart"]);
            }
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == "change") {
    if (isset($_POST["code"]) && isset($_SESSION["shopping_cart"][$_POST["code"]])) {
        $_SESSION["shopping_cart"][$_POST["code"]]["quantity"] = $_POST["quantity"];
        $status = "<div class='box'>Quantidade atualizada!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras | GREECE SPORTS</title>
    <link rel="shortcut icon" href="design_images/greece_icon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <header class="page-header">
        <a href="pagina_home.php">
            <img src="design_images/greece_logo.png" width="264" alt="Logo da Loja">
        </a>
        <div class="header-icons">
            <a href="pagina_login.php">
                <img src="design_images/user_icon.png" width="24" height="24" alt="Minha Conta">
                <p>Minha conta e <br> <strong>Meus pedidos</strong></p>
            </a>
            <a href="pagina_home.php">
                <img src="design_images/favorite_icon.png" width="24" height="24" alt="Favoritos">
            </a>
            <a href="carrinho.php">
                <img src="design_images/bag_icon.png" width="24" height="24" alt="Sacola">
                <?php
                if (!empty($_SESSION["shopping_cart"])) {
                    $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                    echo "<span>$cart_count</span>";
                }
                ?>
            </a>
        </div>
    </header>

    <div class="message_box">
        <?php echo $status; ?>
    </div>

    <div class="cart-container">
        <h2 class="cart-title">Meu Carrinho de Compras</h2>

        <?php
        if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
            $total_price = 0;
        ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION["shopping_cart"] as $product_code => $product) {
                        $subtotal = $product["preco"] * $product["quantity"];
                        $total_price += $subtotal;
                    ?>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="imagens/<?php echo $product["foto"]; ?>" alt="<?php echo $product["descricao"]; ?>">
                                    <div>
                                        <div class="product-name"><?php echo $product["descricao"]; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="code" value="<?php echo $product_code; ?>">
                                    <input type="hidden" name="action" value="change">
                                    <select name="quantity" class="quantity-selector" onchange="this.form.submit()">
                                        <?php for ($i = 1; $i <= 10; $i++) : ?>
                                            <option value="<?php echo $i; ?>" <?php if ($product["quantity"] == $i) echo "selected"; ?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </form>
                            </td>
                            <td>R$ <?php echo number_format($product["preco"], 2, ',', '.'); ?></td>
                            <td>R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="code" value="<?php echo $product_code; ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" class="remove-btn">Remover</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="total-price">Total: R$ <?php echo number_format($total_price, 2, ',', '.'); ?></div>
            </div>

            <div class="cart-actions">
                <a href="pagina_home.php" class="continue-shopping">Continuar Comprando</a>
                <button class="checkout-btn">Finalizar Compra</button>
            </div>
        <?php
        } else {
        ?>
            <div class="empty-cart">
                <div class="empty-cart-icon">🛒</div>
                <h3>Seu carrinho está vazio</h3>
                <p>Explore nossa loja e descubra produtos incríveis!</p>
                <a href="pagina_home.php" class="continue-shopping">Ir às Compras</a>
            </div>
        <?php
        }
        ?>
    </div>

    <footer class="page-footer">
        <p>&copy; 2025 GREECE SPORTS - All rights reserved.</p>
    </footer>


    <style>
        .cart-container {
            max-width: 1200px                          ;
            margin: 20px auto                          ;
            padding: 20px                              ;
            background-color: #ffffff                ;
            border-radius: 8px                         ;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-title {
            text-align: center ;
            margin-bottom: 30px;
            color: #333        ;
            font-size: 24px    ;
        }
        .cart-table {
            width: 100%              ;
            border-collapse: collapse;
            margin-bottom: 20px      ;
        }
        .cart-table th {
            background-color: #f5f5f5  ;
            padding: 12px                ;
            text-align: left             ;
            border-bottom: 2px solid #ddd;
        }
        .cart-table td { 
            padding: 15px 12px           ;
            border-bottom: 1px solid #ddd;
            vertical-align: middle       ;
        }
        .cart-table img {
            max-width: 80px   ;
            border-radius: 4px;
        }
        .product-info {
            display: flex      ;
            align-items: center;
        }
        .product-info img {
            margin-right: 15px;
        }
        .product-name {
            font-weight: bold ;
            color: #333       ;
            margin-bottom: 5px;
        }
        .quantity-selector {
            width: 70px           ;
            padding: 8px          ;
            border: 1px solid #ddd;
            border-radius: 4px    ;
        }
        .remove-btn {
            background-color: #ff0000;
            color: white               ;
            border: none               ;
            padding: 8px 12px          ;
            border-radius: 4px         ;
            cursor: pointer            ;
            font-size: 14px            ;
        }
        .remove-btn:hover {
            background-color: #ff0000;
        }
        .cart-summary {
            display: flex             ;
            justify-content: flex-end ;
            margin-top: 30px          ;
            border-top: 2px solid #ddd;
            padding-top: 20px         ;
        }
        .total-price {
            font-size: 20px  ;
            font-weight: bold;
            color: #333      ;
        }
        .cart-actions {
            display: flex                 ;
            justify-content: space-between; 
            margin-top: 30px              ;
        }
        .continue-shopping {
            text-align: center    ;
            text-decoration: none ;
            font-weight: bold     ;
            width: 50%            ;
            background-color: #333;
            color: white          ;
            border: none          ;
            padding: 10px 20px    ;
            border-radius: 4px    ;
            cursor: pointer       ;
            font-size: 16px       ;
        }
        .checkout-btn {
            text-align: center    ;
            text-decoration: none ;
            font-weight: bold     ;
            width: 50%            ;
            background-color: #000;
            color: white          ;
            border: none          ;
            padding: 10px 20px    ;
            border-radius: 4px    ;
            cursor: pointer       ;
            font-size: 16px       ;
        }

        .continue-shopping:hover, .checkout-btn:hover {
            background-color: #555;
        }
        .empty-cart {
            text-align: center;
            padding: 30px     ;
        }
        .empty-cart h3 {
            font-size: 20px    ;
            color: #333        ;
            margin-bottom: 15px;
        }
        .empty-cart-icon {
            font-size: 60px    ;
            color: #ddd        ;
            margin-bottom: 20px;
        }
        .message_box {
            margin: 20px auto;
            max-width: 1200px;
        }
        .box, .box.error {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px ;
            text-align: center ;
            font-weight: bold  ;
        }
        .box {
            background-color: #008000;
            color: white               ;
        }
        .box.error {
            background-color: #ff0000;
            color: white               ;
        }
    </style>
</body>

</html>