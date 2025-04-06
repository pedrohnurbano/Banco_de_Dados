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