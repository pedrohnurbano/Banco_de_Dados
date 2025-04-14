<!-- Código PHP: -->
<?php
$conectar = mysql_connect('localhost', 'root', '');
$banco = mysql_select_db('loja');
setlocale(LC_ALL, "pt_BR");

// Gravação de dados:
if (isset($_POST['Gravar'])) {
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $cod_marca = $_POST['cod_marca'];
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo = $_POST['cod_tipo'];
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];

    $diretorio = "imagens/";

    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    $novo_nome1 = md5(time() . $extensao1);
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio . $novo_nome1);

    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time() . $extensao2);
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio . $novo_nome2);

    $sql = "INSERT INTO produto (codigo,descricao,cor,tamanho,preco,cod_marca,cod_categoria,cod_tipo,foto_1,foto_2) 
            VALUES ('$codigo','$descricao','$cor','$tamanho','$preco','$cod_marca','$cod_categoria','$cod_tipo','$novo_nome1','$novo_nome2')";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE) {
        echo "Dados gravados com sucesso!";
    } else {
        echo "Erro. - Motivo: Falha ao gravar os dados.";
    }
}

// Alteração de dados:
if (isset($_POST['Alterar'])) {
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $cod_marca = $_POST['cod_marca'];
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo = $_POST['cod_tipo'];
    $foto_1 = $_FILES['foto_1'];
    $foto_2 = $_FILES['foto_2'];

    $sql = "UPDATE produto SET descricao='$descricao',tipo='$tipo',preco='$preco'
            WHERE codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE) {
        echo "Dados alterados com sucesso!";
    } else {
        echo "Erro. - Motivo: Falha ao alterar os dados.";
    }
}

// Exclusão de dados:
if (isset($_POST['Excluir'])) {
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $cod_marca = $_POST['cod_marca'];
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo = $_POST['cod_tipo'];
    $foto_1 = $_FILES['foto_1'];
    $foto_2 = $_FILES['foto_2'];

    $sql = "DELETE FROM produto WHERE codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE) {
        echo "Dados excluídos com sucesso!";
    } else {
        echo "Erro. - Motivo: Falha ao excluir os dados.";
    }
}

// Pesquisa de dados:
if (isset($_POST['Pesquisar'])) {

    $sql = "SELECT codigo,descricao,cor,tamanho,preco,cod_marca,cod_categoria,cod_tipo,foto_1,foto_2 FROM produto";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0) {
        echo "Erro. - Motivo: Dados não encontrados.";
    } else {
        echo "<b>" . "Pesquisa de Produtos: " . "</b><br>";

        while ($dados = mysql_fetch_object($resultado)) {
            echo "Codigo: " . $dados->codigo . " ";
            echo "Descricao: " . $dados->descricao . " ";
            echo "Cor: " . $dados->cor . " ";
            echo "Tamanho: " . $dados->tamanho . " ";
            echo "Preco: " . $dados->preco . " ";
            echo "Marca: " . $dados->cod_marca . " ";
            echo "Categoria: " . $dados->cod_categoria . " ";
            echo "Tipo: " . $dados->cod_tipo . "<br><br>";
            echo '<img src="imagens/' . $dados->foto_1 . '"height="200" width="200" />' . "  ";
            echo '<img src="imagens/' . $dados->foto_2 . '"height="200" width="200" />' . "<br><br>";
        }
    }
}
?>

<!-- Código HTML: -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cadastro de Produtos </title>
    <link rel="shortcut icon" href="design_images/greece_icon.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header><img src="design_images/greece_logo.png" width="150"></header>

    <main>
        <div id="titulo">
            <h1> Formulário de Cadastro de Produtos </h1>
        </div>

        <form class='form' name="formulario" method="POST" action="cad_produto.php" enctype="multipart/form-data">
            <fieldset>
                <legend> Dados do Produto: </legend>
                <label> Código: <input type="text" name="codigo" id="codigo" size="5"></label><br><br>
                <label> Descrição: <input type="text" name="descricao" id="descricao" size="100"></label><br><br>
                <label> Cor: <input type="text" name="cor" id="cor" size="50"></label><br><br>
                <label> Tamanho: <input type="text" name="tamanho" id="tamanho" size="10"></label><br><br>
                <label> Preço: <input type="text" name="preco" id="preco" size="12"></label><br><br>
                <label> Código da Marca: <input type="text" name="cod_marca" id="cod_marca" size="5"></label><br><br>
                <label> Código da Categoria: <input type="text" name="cod_categoria" id="cod_categoria"
                        size="5"></label><br><br>
                <label> Código do Tipo: <input type="text" name="cod_tipo" id="cod_tipo" size="5"></label><br><br>
                <label> Foto 1: <input type="file" name="foto1" id="foto1"></label><br><br>
                <label> Foto 2: <input type="file" name="foto2" id="foto2"></label><br><br>
            </fieldset>
            <button type="submit" name="Gravar" value="Gravar"> Gravar </button>
            <button type="submit" name="Alterar"> Alterar </button>
            <button type="submit" name="Excluir"> Excluir </button>
            <button type="submit" name="Pesquisar"> Pesquisar </button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 GREECE SPORTS - All rights reserved. </p>
    </footer>
</body>
</html>