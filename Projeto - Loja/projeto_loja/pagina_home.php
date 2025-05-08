<?php
// Conexão com o banco de dados usando mysql_
$connect = mysql_connect('localhost', 'root', '');
if (!$connect) {
    die("Erro de conexão: " . mysql_error());
}
$db = mysql_select_db('loja');
if (!$db) {
    die("Erro ao selecionar o banco de dados: " . mysql_error());
}

// Inicialização da sessão
session_start();
$status = ""; // Inicialização da variável $status

// Adicionar produto ao carrinho
if (isset($_POST['codigo']) && $_POST['codigo'] != "") {
    $codigo = $_POST['codigo'];
    $resultado = mysql_query("SELECT descricao, preco, foto_1 FROM produto WHERE codigo = '$codigo'");
    if (!$resultado) {
        die("Erro na consulta SQL: " . mysql_error());
    }
    $row = mysql_fetch_assoc($resultado);

    if ($row) {
        $descricao = $row['descricao'];
        $preco = $row['preco'];
        $foto1 = $row['foto_1'];

        $cartArray = array(
            $codigo => array(
                'codigo' => $codigo,  // Adicionando o código do produto
                'descricao' => $descricao,
                'preco' => $preco,
                'quantity' => 1,
                'foto' => $foto1
            )
        );

        if (empty($_SESSION["shopping_cart"])) {
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "<div class='box'>Produto foi adicionado ao carrinho!</div>";
        } else {
            $array_keys = array_keys($_SESSION["shopping_cart"]);

            if (in_array($codigo, $array_keys)) {
                $status = "<div class='boxerror'>Produto já está no carrinho!</div>";
            } else {
                $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
                $status = "<div class='box'>Produto foi adicionado ao carrinho!</div>";
            }
        }
    } else {
        $status = "<div class='boxerror' style='color:blank;'>Produto não encontrado!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>GREECE SPORTS | Brazil</title>
    <link rel="shortcut icon" href="design_images/greece_icon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="page-body">
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

    <!-- Banner com Setas -->
    <div class="banner-slideshow">
        <div class="slides fade">
            <img src="design_images/banner_01.png" style="width:100%" height="auto">
        </div>
        <div class="slides fade">
            <img src="design_images/banner_02.png" style="width:100%" height="auto">
        </div>
        <div class="slides fade">
            <img src="design_images/banner_03.png" style="width:100%" height="auto">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("slides");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        setInterval(() => {
            plusSlides(1);
        }, 10000);
    </script>

    <div style="clear:both;"></div>
    <div class="message_box" style="margin:10px 0px;">
        <?php echo $status; ?>
    </div>

    <main class="main-container">
        <aside class="filter-sidebar">
            <form name="formulario" method="post" action="pagina_home.php" class="form">
                <fieldset>
                    <legend>FILTROS</legend>

                    <label for="categoria">Categorias:</label>
                    <select name="categoria" id="categoria">
                        <option value="" selected>Selecione...</option>
                        <?php
                        $query = mysql_query("SELECT codigo, nome FROM categoria");
                        while ($categorias = mysql_fetch_array($query)) {
                            echo '<option value="' . $categorias['codigo'] . '">' . $categorias['nome'] . '</option>';
                        }
                        ?>
                    </select>

                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo">
                        <option value="" selected>Selecione...</option>
                        <?php
                        $query = mysql_query("SELECT codigo, nome FROM tipo");
                        while ($tipo = mysql_fetch_array($query)) {
                            echo '<option value="' . $tipo['codigo'] . '">' . $tipo['nome'] . '</option>';
                        }
                        ?>
                    </select>

                    <label for="marca">Marcas:</label>
                    <select name="marca" id="marca">
                        <option value="" selected>Selecione...</option>
                        <?php
                        $query = mysql_query("SELECT codigo, nome FROM marca");
                        while ($marcas = mysql_fetch_array($query)) {
                            echo '<option value="' . $marcas['codigo'] . '">' . $marcas['nome'] . '</option>';
                        }
                        ?>
                    </select>

                    <button type="submit" name="pesquisar">Pesquisar</button>
                </fieldset>
            </form>
        </aside>

        <section class="product-list">
            <?php
            // Consulta padrão para listar todos os produtos
            $sql_produtos = "SELECT produto.codigo, produto.descricao, produto.cor, produto.tamanho, produto.preco, produto.foto_1, produto.foto_2
                             FROM produto
                             INNER JOIN marca ON produto.cod_marca = marca.codigo
                             INNER JOIN categoria ON produto.cod_categoria = categoria.codigo
                             INNER JOIN tipo ON produto.cod_tipo = tipo.codigo";

            if (isset($_POST['pesquisar'])) {
                $marca = (empty($_POST['marca'])) ? 'null' : mysql_real_escape_string($_POST['marca']);
                $categoria = (empty($_POST['categoria'])) ? 'null' : mysql_real_escape_string($_POST['categoria']);
                $tipo = (empty($_POST['tipo'])) ? 'null' : mysql_real_escape_string($_POST['tipo']);

                $conditions = array();

                if ($marca != 'null') {
                    $conditions[] = "marca.codigo = $marca";
                }
                if ($categoria != 'null') {
                    $conditions[] = "categoria.codigo = $categoria";
                }
                if ($tipo != 'null') {
                    $conditions[] = "tipo.codigo = $tipo";
                }

                if (!empty($conditions)) {
                    $sql_produtos .= " WHERE " . implode(' AND ', $conditions);
                }
            }

            $seleciona_produtos = mysql_query($sql_produtos);

            if (mysql_num_rows($seleciona_produtos) == 0) {
                echo '<h3>Desculpe, mas sua busca não retornou resultados.</h3>';
            } else {
                echo "<h3>Produtos encontrados:</h3>";
                echo '<div class="product-grid">';
                while ($dados = mysql_fetch_object($seleciona_produtos)) {
                    echo "<div class='product-card'>";
                    echo "<form method='post' action=''>";
                    echo "<img src='imagens/{$dados->foto_1}' alt='Foto 1'>";
                    echo "<h4>{$dados->descricao}</h4>";
                    echo "<p>Cor: {$dados->cor}</p>";
                    echo "<p>Tamanho: {$dados->tamanho}</p>";
                    echo "<p>Preço: R$ {$dados->preco}</p>";
                    echo "<input type='hidden' name='codigo' value='{$dados->codigo}'>";
                    echo "<button class='buy-button'>Comprar</button>";
                    echo "</form>";
                    echo "</div>";
                }
                echo '</div>';
            }
            ?>
        </section>
    </main>

    <footer class="page-footer">
        <p>&copy; 2025 GREECE SPORTS - All rights reserved.</p>
    </footer>
</body>

</html>