<!-- Código PHP: -->
<?php
$connect = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('loja');
?>

<!-- Código HTML: -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title> GREECE SPORTS | Brazil </title>
    <link rel="shortcut icon" href="design_images/greece_icon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <a href="pagina_home.php">
            <img src="design_images/greece_logo.png" width="264" alt="Logo da Loja">
        </a>

        <a href="pagina_login.php">
            <img src="design_images/search_icon.png" width="24" height="24" alt="Pesquisar">
        </a>

        <a href="pagina_login.php">
            <img src="design_images/user_icon.png" width="24" height="24" alt="Login">
        </a>

        <a href="pagina_home.php">
            <img src="design_images/favorite_icon.png" width="24" height="24" alt="Favoritos">
        </a>

        <a href="pagina_home.php">
            <img src="design_images/bag_icon.png" width="24" height="24" alt="Sacola">
        </a>
    </header>

    <!-- Banner com Setas: -->
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

        <!-- Setas do Banner: -->
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

    <main>
        <div id="titulo">
            <h1> Material Esportivo </h1>
        </div>

        <section>
            <h2>Pesquisas:</h2>
            <form name="formulario" method="post" action="pesquisar.php" class="form">

                <!-- Categorias: -->
                <label for="categoria"> Categorias: </label>
                <select name="categoria" id="categoria">
                    <option value="" selected> Selecione... </option>
                    <?php
                    $query = mysql_query("SELECT codigo, descricao FROM categoria");
                    while ($categorias = mysql_fetch_array($query)) {
                        echo '<option value="' . $categorias['codigo'] . '">' . $categorias['descricao'] . '</option>';
                    }
                    ?>
                </select>

                <!-- Tipos: -->
                <label for="tipo"> Tipo: </label>
                <select name="tipo" id="tipo">
                    <option value="" selected> Selecione... </option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM tipo");
                    while ($tipo = mysql_fetch_array($query)) {
                        echo '<option value="' . $tipo['codigo'] . '">' . $tipo['nome'] . '</option>';
                    }
                    ?>
                </select>

                <!-- Marcas: -->
                <label for="marca"> Marcas: </label>
                <select name="marca" id="marca">
                    <option value="" selected> Selecione... </option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM marca");
                    while ($marcas = mysql_fetch_array($query)) {
                        echo '<option value="' . $marcas['codigo'] . '">' . $marcas['nome'] . '</option>';
                    }
                    ?>
                </select>

                <button type="submit" name="pesquisar"> Pesquisar </button>
            </form>
        </section>

        <section>
            <?php
            if (isset($_POST['pesquisar'])) {
                $marca = (empty($_POST['marca'])) ? 'null' : $_POST['marca'];
                $categoria = (empty($_POST['categoria'])) ? 'null' : $_POST['categoria'];
                $tipo = (empty($_POST['tipo'])) ? 'null' : $_POST['tipo'];

                if (($marca != 'null') && ($categoria == 'null') && ($tipo == 'null')) {
                    $sql_produtos = "SELECT produto.descricao, produto.cor, produto.tamanho, produto.preco, produto.foto1, produto.foto2
                                     FROM produto, marca, categoria, tipo
                                     WHERE produto.codmarca = marca.codigo
                                     AND produto.codcategoria = categoria.codigo
                                     AND produto.codtipo = tipo.codigo
                                     AND marca.codigo = $marca";

                    $seleciona_produtos = mysql_query($sql_produtos);

                    if (mysql_num_rows($seleciona_produtos) == 0) {
                        echo '<h3>Desculpe, mas sua busca não retornou resultados.</h3>';
                    } else {
                        echo "<h3>Resultado da pesquisa de Produtos:</h3>";
                        while ($dados = mysql_fetch_object($seleciona_produtos)) {
                            echo "<div class='produto'>";
                            echo "<p><strong>Descrição:</strong> {$dados->descricao}<br>";
                            echo "<strong>Cor:</strong> {$dados->cor}<br>";
                            echo "<strong>Tamanho:</strong> {$dados->tamanho}<br>";
                            echo "<strong>Preço:</strong> R$ {$dados->preco}</p>";
                            echo "<img src='fotos/{$dados->foto1}' height='100' width='150' alt='Foto 1'>";
                            echo "<img src='fotos/{$dados->foto2}' height='100' width='150' alt='Foto 2'>";
                            echo "</div><br>";
                        }
                    }
                }
            }
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 GREECE SPORTS - All rights reserved. </p>
    </footer>
</body>
</html>

<!-- --------------------------------------------------------------- -->
<!-- CÓDIGO DO COPILOT GITHUB: -->
<!-- --------------------------------------------------------------- -->

<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('loja');

function obterCategorias()
{
    $query = mysql_query("SELECT codigo, descricao FROM categoria");
    $categorias = [];
    while ($linha = mysql_fetch_assoc($query)) {
        $categorias[] = $linha;
    }
    return $categorias;
}

function obterTipos()
{
    $query = mysql_query("SELECT codigo, nome FROM tipo");
    $tipos = [];
    while ($linha = mysql_fetch_assoc($query)) {
        $tipos[] = $linha;
    }
    return $tipos;
}

function obterMarcas()
{
    $marca = isset($_POST['marca']) ? intval($_POST['marca']) : null;
    $categoria = isset($_POST['categoria']) ? intval($_POST['categoria']) : null;
    $tipo = isset($_POST['tipo']) ? intval($_POST['tipo']) : null;

    $sql = "SELECT descricao, cor, tamanho, preco, foto_1, foto_2 FROM produto WHERE 1=1";

    if (!empty($marca)) {
        $sql .= " AND cod_marca = $marca";
    }
    if (!empty($categoria)) {
        $sql .= " AND cod_categoria = $categoria";
    }
    if (!empty($tipo)) {
        $sql .= " AND cod_tipo = $tipo";
    }

    $resultado = mysql_query($sql);
    while ($linha = mysql_fetch_assoc($resultado)) {
        $produtos[] = $linha;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GREECE SPORTS | Página Home</title>
    <link rel="shortcut icon" href="design_images/greece_icon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <a href="pagina_home.php">
            <img src="design_images/greece_logo.png" width="150" alt="Logo da Loja">
        </a>
    </header>

    <div class="banner-slideshow">
        <div class="slides fade"></div>
            <img src="design_images/banner_01.png" style="width:100%">
        </div>
        <div class="slides fade">
            <img src="design_images/banner_02.png" style="width:100%">
        </div>
        <div class="slides fade">
            <img src="design_images/banner_03.png" style="width:100%">
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
            const slides = document.getElementsByClassName("slides");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        setInterval(() => plusSlides(1), 10000);
    </script>

    <main>
        <div id="titulo">
            <h1>Material Esportivo</h1>
        </div>

        <section>
            <h2>Pesquisas:</h2>
            <form method="POST" action="pagina_home.php" class="form">
                <label for="categoria">Categorias:</label>
                <select name="categoria" id="categoria">
                    <option value="">Selecione...</option>
                    <?php foreach (obterCategorias() as $categoria): ?>
                        <option value="<?= $categoria['codigo'] ?>"><?= $categoria['descricao'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="tipo">Tipos:</label>
                <select name="tipo" id="tipo">
                    <option value="">Selecione...</option>
                    <?php foreach (obterTipos() as $tipo): ?>
                        <option value="<?= $tipo['codigo'] ?>"><?= $tipo['nome'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="marca">Marcas:</label>
                <select name="marca" id="marca">
                    <option value="">Selecione...</option>
                    <?php foreach (obterMarcas() as $marca): ?>
                        <option value="<?= $marca['codigo'] ?>"><?= $marca['nome'] ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="pesquisar">Pesquisar</button>
            </form>
        </section>

        <section>
            <?php if (!empty($produtos)): ?>
                <h3>Resultado da pesquisa de produtos:</h3>
                <?php foreach ($produtos as $produto): ?>
                    <div class="produto">
                        <p><strong>Descrição:</strong> <?= $produto['descricao'] ?><br>
                            <strong>Cor:</strong> <?= $produto['cor'] ?><br>
                            <strong>Tamanho:</strong> <?= $produto['tamanho'] ?><br>
                            <strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </p>
                        <img src="imagens/<?= $produto['foto_1'] ?>" height="100" width="150" alt="Foto 1">
                        <img src="imagens/<?= $produto['foto_2'] ?>" height="100" width="150" alt="Foto 2">
                    </div>
                <?php endforeach; ?>
            <?php elseif (isset($_POST['pesquisar'])): ?>
                <h3>Desculpe, mas sua busca não retornou resultados.</h3>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 GREECE SPORTS - Todos os direitos reservados.</p>
    </footer>
</body>

</html>

<!-- --------------------------------------------------------------- -->