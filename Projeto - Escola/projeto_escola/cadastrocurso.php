<?php

// Conectar com o Banco de Dados:
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('escola');

if (isset($_POST['Gravar']))
{
    $cod_curso       = $_POST['cod_curso'];
    $nome            = $_POST['nome'];
    $cod_coordenador = $_POST['cod_coordenador'];

    $sql = "insert into curso (cod_curso, nome, cod_coordenador)
            values ('$cod_curso','$nome','$cod_coordenador')";

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
    $cod_curso       = $_POST['cod_curso'];
    $nome            = $_POST['nome'];
    $cod_coordenador = $_POST['cod_coordenador'];

    $sql = "update curso set nome = '$nome', cod_coordenador = '$cod_coordenador'
            where cod_curso = '$cod_curso'";

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
    $cod_curso       = $_POST['cod_curso'];

    $sql = "delete from curso where cod_curso = '$cod_curso'";

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

    $sql = "select * from curso";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0)
    {
    echo "Erro. - Motivo: Dados não encontrados.";
    }
    else
    {
        echo "<b>"."Pesquisa de Cursos: "."</b><br>";
        while ($dados = mysql_fetch_array($resultado))
            {
                echo "Código: ".$dados['cod_curso']."<br>".
                     "Nome: ".$dados['nome']."<br>";
                     "Código do Coordenador: ".$dados['cod_coordenador']."<br>";
            }
    }   
}

?>