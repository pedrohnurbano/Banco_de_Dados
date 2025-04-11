<?php

// Conectar com o Banco de Dados:
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('loja');

if (isset($_POST['Gravar']))
{
    $codigo = $_POST['codigo'];
    $nome   = $_POST['nome'];

    $sql = "insert into categoria (codigo, nome)
            values ('$codigo','$nome')";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE)
    {
        echo "Dados gravados com sucesso!";
    }
    else
    {
        echo "Erro. - Motivo: Falha ao gravar os dados.";
    }
}

//------------------------------------------------------------------------------

if (isset($_POST['Alterar']))
{

//Receber as variáveis do HTML:
    $codigo = $_POST['codigo'];
    $nome   = $_POST['nome'];

    $sql = "update categoria set nome = '$nome',
            where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE)
    {
        echo "Dados alterados com sucesso!";
    }
    else
    {
        echo "Erro. - Motivo: Falha ao alterar os dados.";
    }
}

//------------------------------------------------------------------------------

if (isset($_POST['Excluir']))
{

//Receber as variáveis do HTML:
    $codigo = $_POST['codigo'];
    $nome            = $_POST['nome'];

    $sql = "delete from categoria where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE)
    {
        echo "Dados excluídos com sucesso!";
    }
    else
    {
        echo "Erro. - Motivo: Falha ao excluir os dados.";
    }
}

//------------------------------------------------------------------------------

if (isset($_POST['Pesquisar']))
{
//Receber as variáveis do HTML:

    $sql = "select * from categoria";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0)
    {
    echo "Erro. - Motivo: Dados não encontrados.";
    }
    else
    {
        echo "<b>"."Pesquisa de Categorias: "."</b><br>";
        while ($dados = mysql_fetch_array($resultado))
            {
                echo "Código: ".$dados['codigo']."<br>".
                     "Nome: ".$dados['nome']."<br>";
            }
    }   
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cadastro de Categorias </title>
    <link rel="shortcut icon" href="loja_icone.png" type="image/png">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header><img src="loja_logo.png" width="150"></header>

    <main>
        <div id="titulo">
            <h1> Formulário de Cadastro de Categorias </h1>
        </div>

        <form class='form' name="formulario" method="POST" action="cad_categoria.php">
            <fieldset>
                <legend> Dados da Categoria: </legend>
                <label>  Código: <input type="text" name="codigo" id="codigo" size="5" ></label><br><br>
                <label>  Nome:   <input type="text" name="nome"   id="nome"   size="50"></label><br><br>
            </fieldset>
            <button type="submit" name="Gravar">    Gravar    </button>
            <button type="submit" name="Alterar">   Alterar   </button>
            <button type="submit" name="Excluir">   Excluir   </button>
            <button type="submit" name="Pesquisar"> Pesquisar </button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Visual Modas By Kel - Todos os direitos reservados. </p>
    </footer>
</body>

</html>