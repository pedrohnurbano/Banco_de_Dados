<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('escola');

if (isset($_POST['Entrar']))
    {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $sql = "SELECT email, senha FROM usuario
            WHERE email = '$email' and senha = '$senha'";
    
    $resultado = mysql_query($sql);
    
    if (mysql_num_rows($resultado) <= 0 )
    {
       echo "<script language='javascript' type='text/javascript'>
            alert('E-mail e/ou senha incorreto (s)!');
            window.location.href='pagina_login.php';
            </script>";
        }
        else
        {
            setcookie('login',$login);
            header('Location:pagina_menu.html');
        }
    }
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Página de Login </title>
    <link rel="shortcut icon" href="satc_icon.png" type="image/png">
    <link rel="stylesheet"    href="styles.css">
</head>

<body>
    <header><img src = "satc_logo.png" width="150"></header>

    <main>
        <div id="titulo">
            <h1> Login do Usuário </h1>
        </div>

        <form class='form' name="formulario" method="POST" action="pagina_login.php">
            <fieldset>
                <legend> Dados de Acesso: </legend>
                <label>  E-mail: <input type="text"     name="email" id="email" required></label><br>
                <label>  Senha:  <input type="password" name="senha" id="senha" required></label><br>
            </fieldset>
            <button type="submit" name="Entrar"> Entrar </button>
        </form>
    </main>

    <footer>
        <p>&copy; 2025 Pedro Henrique do Nascimento Urbano - Todos os direitos reservados. </p>
    </footer>
</body>

</html>