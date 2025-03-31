<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="shortcut icon" href="img/ai-generated-8558592_1920.png" type="image/x-icon">

    <style>
        @font-face {
            font-family: 'MinhaFonte';
            src: url('img-fontes/the_wild_breath_of_zelda/The Wild Breath of Zelda.otf') format('truetype');
            }
        body{
            font-family: 'MinhaFonte', sans-serif;
            
            justify-content: center;
            justify-items: center;
            align-items: center;
            min-height: 100vh;
            min-width: auto;
            background-image: url('img-fontes/background.jpeg'); /* Caminho da imagem */
            background-size: cover; /* Faz a imagem cobrir toda a tela */
            background-position: center; /* Centraliza a imagem */
            background-attachment: fixed; /* Mantém a imagem fixa ao rolar a página */
            border-radius: 5px;
            margin-top: 0;}
            
        .navbar {
            background: rgba(0, 0, 0, 0.45);
            padding: 10px;
            width: 100%;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        h1{
                display: grid;
                justify-items: center;
                align-items: center;

        }
        
        .menu{
            background-position: center;
            background-color:rgba(0, 0, 0, 0.45);
            color: rgb(167, 167, 167);
            display: grid;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: bolder;
            font-size:larger;
            border-radius: 10px;
            padding: 5px;
            height: 200px;
            width: 200px;
            border:5px solid;
            margin-top: 200px;
         
            a{
                margin: 5px;
                color: black;
                font-size: larger;
               
            }
        }

    </style>
</head>
<body> 
<div class="navbar">
        <a href="index.php">Menu</a>
        <a href="cadastro.php">Cadastro de Itens</a>
        <a href="inventario.php">Inventario</a>
</div>
<?php
session_start(); // Inicia a sessão

// Definição de constantes para login
const USER = "User";
const PASSWORD = "user12345";

// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Validação de login
    if ($usuario === USER && $senha === PASSWORD) {
        $_SESSION['usuario_logado'] = true; // Armazena a sessão de login
    } else {
        echo '<h1 class="text-white bg-danger p-3 rounded text-center">Usuário ou senha incorretos!</h1>';
        echo '<div class="text-center"><a href="index.html" class="btn btn-warning">Tente novamente</a></div>';
        exit(); // Interrompe a execução para evitar exibir o menu
    }
}

// Verifica se o usuário está logado antes de exibir o menu
if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true) {
    echo '<div class="menu">
            <a href="cadastro.php">Cadastro de Itens</a>
            <a href="inventario.php">Inventário</a>
          </div>';
} else {
    echo '<h1 class="text-white bg-danger p-3 rounded text-center">Acesso negado! Faça login.</h1>';
    echo '<div class="text-center"><a href="index.html" class="btn btn-warning">Login</a></div>';
    exit();
}
?>



</body>
</html>