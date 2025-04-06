<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('loja')             ;
setlocale(LC_ALL,"pt_BR")                       ;

if (isset($_POST['Gravar']))
{
    $codigo        = $_POST['codigo']       ;
    $descricao     = $_POST['descricao']    ;
    $cor           = $_POST['cor']          ;
    $tamanho       = $_POST['tamanho']      ;
    $preco         = $_POST['preco']        ;
    $cod_marca     = $_POST['cod_marca']    ;
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo      = $_POST['cod_tipo']     ;
    $foto1         = $_FILES['foto1']       ;
    $foto2         = $_FILES['foto2']       ;

    $diretorio = "imagens/";

    $extensao1 = strtolower(substr($_FILES['foto1']['name'], -4));
    $novo_nome1 = md5(time().$extensao1);
    move_uploaded_file($_FILES['foto1']['tmp_name'], $diretorio.$novo_nome1);
    
    $extensao2 = strtolower(substr($_FILES['foto2']['name'], -6));
    $novo_nome2 = md5(time().$extensao2);
    move_uploaded_file($_FILES['foto2']['tmp_name'], $diretorio.$novo_nome2);
    
    $sql = "INSERT INTO produto (codigo,descricao,cor,tamanho,preco,cod_marca,cod_categoria,cod_tipo,foto_1,foto_2) 
            VALUES ('$codigo','$descricao','$cor','$tamanho','$preco','$cod_marca','$cod_categoria','$cod_tipo','$novo_nome1','$novo_nome2')";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE)
    {echo "Dados gravados com sucesso!";}
    else
    {echo "Erro. - Motivo: Falha ao gravar os dados.";}
}

if (isset($_POST['Alterar']))
{
    $codigo        = $_POST['codigo'];
    $descricao     = $_POST['descricao'];
    $cor           = $_POST['cor'];
    $tamanho       = $_POST['tamanho'];
    $preco         = $_POST['preco'];
    $cod_marca     = $_POST['cod_marca'];
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo      = $_POST['cod_tipo'];
    $foto_1        = $_FILES['foto_1'];
    $foto_2        = $_FILES['foto_2'];

    $sql = "UPDATE produto SET descricao='$descricao',tipo='$tipo',preco='$preco'
            WHERE codigo = '$codigo'";
    
    $resultado = mysql_query($sql);

    if ($resultado == TRUE)
    {echo "Dados alterados com sucesso!";}
    else
    {echo "Erro. - Motivo: Falha ao alterar os dados.";}
}

if (isset($_POST['Excluir']))
{
    $codigo        = $_POST['codigo'];
    $descricao     = $_POST['descricao'];
    $cor           = $_POST['cor'];
    $tamanho       = $_POST['tamanho'];
    $preco         = $_POST['preco'];
    $cod_marca     = $_POST['cod_marca'];
    $cod_categoria = $_POST['cod_categoria'];
    $cod_tipo      = $_POST['cod_tipo'];
    $foto_1        = $_FILES['foto_1'];
    $foto_2        = $_FILES['foto_2'];

    $sql = "DELETE FROM produto WHERE codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado == TRUE)
    {echo "Dados excluídos com sucesso!";}
    else
    {echo "Erro. - Motivo: Falha ao excluir os dados.";}
}

if (isset($_POST['Pesquisar']))
{

$sql = "SELECT codigo,descricao,cor,tamanho,preco,cod_marca,cod_categoria,cod_tipo,foto_1,foto_2 FROM produto";

    $resultado = mysql_query($sql);

    if (mysql_num_rows($resultado) == 0)
    {echo "Erro. - Motivo: Dados não encontrados.";}
    else
    {echo "<b>"."Pesquisa de Produtos: "."</b><br>";

        while ($dados = mysql_fetch_object($resultado))
            {    
                echo "Codigo: ".$dados->codigo." ";
                echo "Descricao: ".$dados->descricao." ";
                echo "Cor: ".$dados->cor." ";
                echo "Tamanho: ".$dados->tamanho." ";
                echo "Preco: ".$dados->preco." ";
                echo "Marca: ".$dados->cod_marca." ";
                echo "Categoria: ".$dados->cod_categoria." ";
                echo "Tipo: ".$dados->cod_tipo."<br><br>";
                echo '<img src="imagens/'.$dados->foto_1.'"height="200" width="200" />'."  ";
                echo '<img src="imagens/'.$dados->foto_2.'"height="200" width="200" />'."<br><br>";
            }
    }   
}
?>