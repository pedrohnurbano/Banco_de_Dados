<?php
session_start();
$status = "";

// Remover produto do carrinho
if (isset($_POST['action']) && $_POST['action'] == "remove") {
    if (!empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if (isset($_POST["codigo"]) && $_POST["codigo"] == $key) { // Verifica se 'codigo' está definido
                unset($_SESSION["shopping_cart"][$key]);
                $status = "<div class='boxerror'>Produto foi removido do carrinho!</div>";
            }
            if (empty($_SESSION["shopping_cart"])) {
                unset($_SESSION["shopping_cart"]);
            }
        }
    }
}

// Alterar quantidade do produto no carrinho
if (isset($_POST['action']) && $_POST['action'] == "change") {
    foreach ($_SESSION["shopping_cart"] as &$value) {
        if (isset($_POST["codigo"]) && $value['codigo'] === $_POST["codigo"]) { // Verifica se 'codigo' está definido
            $value['quantity'] = $_POST["quantity"];
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="cart">
        <?php
        if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
            $total_price = 0;
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION["shopping_cart"] as $product) {
                        ?>
                        <tr>
                            <td>
                                <img src="imagens/<?php echo $product["foto"]; ?>" alt="Produto" width="50">
                                <?php echo $product["descricao"]; ?>
                            </td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="codigo" value="<?php echo $product["codigo"]; ?>" />
                                    <input type="hidden" name="action" value="change" />
                                    <select name="quantity" class="quantity" onChange="this.form.submit()">
                                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                                            <option value="<?php echo $i; ?>" <?php if ($product["quantity"] == $i) echo "selected"; ?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo "R$ " . number_format($product["preco"], 2, ',', '.'); ?></td>
                            <td><?php echo "R$ " . number_format($product["preco"] * $product["quantity"], 2, ',', '.'); ?></td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="codigo" value="<?php echo $product["codigo"]; ?>" />
                                    <input type="hidden" name="action" value="remove" />
                                    <button type="submit" class="remove">Remover</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $total_price += $product["preco"] * $product["quantity"];
                    }
                    ?>
                    <tr>
                        <td colspan="5" align="right">
                            <strong>Total: <?php echo "R$ " . number_format($total_price, 2, ',', '.'); ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        } else {
            echo "<h3>Seu carrinho está vazio!</h3>";
        }
        ?>
    </div>

    <div class="message_box">
        <?php echo $status; ?>
    </div>
</body>

</html>