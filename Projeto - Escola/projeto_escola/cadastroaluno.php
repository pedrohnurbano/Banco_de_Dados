<?php

// Conectar com o Banco de Dados:
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('escola');

if (isset($_POST['Gravar']))
{
    $cod_aluno = $_POST['cod_aluno'];
    $nome      = $_POST['nome'];
    $telefone  = $_POST['telefone'];
    $cod_curso = $_POST['cod_curso'];

    $sql = "insert into aluno (cod_aluno, nome, telefone, cod_curso)
            values ('$cod_aluno','$nome','$telefone','$cod_curso')";

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
    $cod_aluno       = $_POST['cod_aluno'];
    $nome            = $_POST['nome'];
    $telefone        = $_POST['telefone'];
    $cod_curso       = $_POST['cod_curso'];

    $sql = "update aluno set nome = '$nome', telefone = '$telefone', cod_curso = '$cod_curso'
            where cod_aluno = '$cod_aluno'";

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
    $cod_coordenador = $_POST['cod_coordenador'];
    $nome            = $_POST['nome'];

    $sql = "delete from coordenador where cod_coordenador = '$cod_coordenador'";

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

    $sql = "select * from coordenador";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0)
    {
    echo "Erro. - Motivo: Dados não encontrados.";
    }
    else
    {
        echo "<b>"."Pesquisa de Coordenadores: "."</b><br>";
        while ($dados = mysql_fetch_array($resultado))
            {
                echo "Código: ".$dados['cod_coordenador']."<br>".
                    "Nome: ".$dados['nome']."<br>";
            }
    }   
}

?>