<?php
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('loja');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title> Home - Visual Modas By Kel </title>
    <link rel="shortcut icon" href="loja_icon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <img src="loja_logo.png" width="150" alt="Logo da Loja">
        <a href="pagina_login.php">
            <img src="usuario_icon.png" width="24" height="24" alt="Login">
        </a>

        <a href="pagina_home.php">
            <img src="favoritos_icon.png" width="24" height="24" alt="Favoritos">
        </a>

        <a href="pagina_home.php">
            <img src="sacola_icon.png" width="24" height="24" alt="Sacola">
        </a>
    </header>

    <!-- Banner com Setas -->
    <div class="banner-slideshow">
        <div class="slides fade">
            <img src="banner_01.png" style="width:100%">
        </div>
        <div class="slides fade">
            <img src="banner_02.png" style="width:100%">
        </div>
        <div class="slides fade">
            <img src="banner_03.png" style="width:100%">
        </div>

        <!-- Setas -->
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
        }, 10000); // Muda a cada 10 segundos
    </script>

    <!-- --------------- -->

    <main>
        <div id="titulo">
            <h1>Material Esportivo</h1>
        </div>

        <section>
            <h2>Pesquisas:</h2>
            <form name="formulario" method="post" action="pesquisar.php" class="form">

                <!-- Categorias -->
                <label for="categoria">Categorias:</label>
                <select name="categoria" id="categoria">
                    <option value="" selected>Selecione...</option>
                    <?php
                    $query = mysql_query("SELECT codigo, descricao FROM categoria");
                    while($categorias = mysql_fetch_array($query)) {
                        echo '<option value="'.$categorias['codigo'].'">'.$categorias['descricao'].'</option>';
                    }
                    ?>
                </select>

                <!-- Classificação -->
                <label for="classificacao">Classificação:</label>
                <select name="classificacao" id="classificacao">
                    <option value="" selected>Selecione...</option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM classificacao");
                    while($classificacao = mysql_fetch_array($query)) {
                        echo '<option value="'.$classificacao['codigo'].'">'.$classificacao['nome'].'</option>';
                    }
                    ?>
                </select>

                <!-- Marcas -->
                <label for="marca">Marcas:</label>
                <select name="marca" id="marca">
                    <option value="" selected>Selecione...</option>
                    <?php
                    $query = mysql_query("SELECT codigo, nome FROM marca");
                    while($marcas = mysql_fetch_array($query)) {
                        echo '<option value="'.$marcas['codigo'].'">'.$marcas['nome'].'</option>';
                    }
                    ?>
                </select>

                <button type="submit" name="pesquisar">Pesquisar</button>
            </form>
        </section>

        <section>
            <?php
            if (isset($_POST['pesquisar'])) {
                $marca         = (empty($_POST['marca'])) ? 'null' : $_POST['marca'];
                $categoria     = (empty($_POST['categoria'])) ? 'null' : $_POST['categoria'];
                $classificacao = (empty($_POST['classificacao'])) ? 'null' : $_POST['classificacao'];

                if (($marca != 'null') && ($categoria == 'null') && ($classificacao == 'null')) {
                    $sql_produtos = "SELECT produto.descricao, produto.cor, produto.tamanho, produto.preco, produto.foto1, produto.foto2
                                     FROM produto, marca, categoria, classificacao
                                     WHERE produto.codmarca = marca.codigo
                                     AND produto.codcategoria = categoria.codigo
                                     AND produto.codclassificacao = classificacao.codigo
                                     AND marca.codigo = $marca";

                    $seleciona_produtos = mysql_query($sql_produtos);

                    if(mysql_num_rows($seleciona_produtos) == 0) {
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
        <p>&copy; 2025 Visual Modas By Kel - Todos os direitos reservados. </p>
    </footer>
</body>

</html>
