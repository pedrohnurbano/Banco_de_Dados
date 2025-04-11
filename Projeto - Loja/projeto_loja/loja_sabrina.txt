<?php
    $connect = mysql_connect("localhost","root","");
    $db = mysql_select_db("loja");
?>

<!DOCTYPE html>
<html>

<head>
    <title> Página Inicial </title>
    <link rel="stylesheet" href="stylesteste.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>

    <header>

        <a href="pesquisa.php" id="logo"><img src="https://www.sportsstore.it/assets/img/logo.png" height=95></a>
        <a href="login.php" id="logologin"><img src="https://img.icons8.com/?size=100&id=9ZgJRZwEc5Yj&format=png&color=FFFFFF" height=45></a>

    </header>

    <div id="barrapesquisa">

        <form name="formulario" method="post" action="pesquisa.php" id="formpesquisa">

            <!-- pesquisar Categorias -->
            <p>Categorias: </p>
            <select name="categoria">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM categoria");
            while($categorias = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $categorias['codigo']?>">
                        <?php echo $categorias['nome']?></option>
            <?php }
            ?>
            </select>

            <!-- pesquisar Tipo -->
            <p>Tipos: </p>
            <select name="tipo">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM tipo");
            while($tipos = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $tipos['codigo']?>">
                        <?php echo $tipos['nome']?></option>
            <?php }
            ?>
            </select>

            <!-- pesquisar Marcas -->
            <p>Marcas: </p>
            <select name="marca">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM marca");
            while($marcas = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $marcas['codigo']?>">
                        <?php echo $marcas['nome']?></option>
            <?php }
            ?>
            </select>

            <input  type="submit" name="pesquisar" value="Pesquisar">

        </form>

    </div>

    <?php
    /* pesquisar produtos qdo carrega a pagina 1vez  */
    $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2 FROM produto";                
    $seleciona_produtos = mysql_query($sql_produtos);    

    if (isset($_POST['pesquisar'])) //verifica que a opção marca e modelo foi selecionada ou não
    {
    /* pesquisar produtos qdo pessiona pesquisar */
    $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                    FROM produto";
                                        
    $seleciona_produtos = mysql_query($sql_produtos);

    $marca     = (empty($_POST['marca']))? 'null' : $_POST['marca'];
    $categoria = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
    $tipo      = (empty($_POST['tipo']))? 'null' : $_POST['tipo'];

    if (($marca <> 'null') and ($categoria == 'null') and ($tipo == 'null')) //pesquisar Marca escolhida
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca == 'null') and ($categoria <> 'null') and ($tipo == 'null')) //pesquisar Categoria escolhida
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca == 'null') and ($categoria == 'null') and ($tipo <> 'null')) //pesquisar Tipo escolhido
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and tipo.codigo = '$tipo'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca <> 'null') and ($categoria <> 'null') and ($tipo == 'null')) //pesquisar Marca e Categoria escolhidas
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca == 'null') and ($categoria <> 'null') and ($tipo <> 'null')) //pesquisar Categoria e Tipo escolhidos
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and tipo.codigo = '$tipo'
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca <> 'null') and ($categoria == 'null') and ($tipo <> 'null')) //pesquisar Marca e Tipo escolhidos
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'
                                and tipo.codigo = '$tipo'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }

    if (($marca <> 'null') and ($categoria <> 'null') and ($tipo <> 'null')) //pesquisar Marca, Categoria e Tipo escolhidos
            {
                $sql_produtos = "SELECT produto.nome,produto.descricao,produto.cor,produto.tamanho,produto.preco,produto.foto1,produto.foto2
                                FROM produto, marca, categoria, tipo
                                WHERE produto.codmarca = marca.codigo
                                and produto.codcategoria = categoria.codigo
                                and produto.codtipo = tipo.codigo
                                and marca.codigo = '$marca'
                                and tipo.codigo = '$tipo'
                                and categoria.codigo = '$categoria'";
                                        
                $seleciona_produtos = mysql_query($sql_produtos);
            }
        }
    
    // mostrar as informações dos produtos 
    if(mysql_num_rows($seleciona_produtos) == 0) {
        echo '<h1> Desculpe, sua busca não retornou resultados. </h1>';
    }
    else {
        echo "Resultado da pesquisa de Produtos: <br><br>";
        while ($dados = mysql_fetch_object($seleciona_produtos)) {
            echo "<div id="">";
            echo "<p> Nome:".$dados->nome." </p>";
            echo "Descrição:".$dados->descricao." ";
            echo "Cor: ".$dados->cor." ";
            echo "Tamanho: ".$dados->tamanho." ";
            echo "Preço R$: ".$dados->preco."<br>";
            echo '<img src="imgbanco/'.$dados->foto1.'" height="150" width="150" />'." ";
            echo '<img src="imgbanco/'.$dados->foto2.'" height="150" width="150" />'."<br><br>";
        }
    }
        
    ?>