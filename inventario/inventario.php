<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário</title>
    <link rel="shortcut icon" href="img-fontes/favicon/favicon-32x32.png" type="image/x-icon">

    <style>
        @font-face {
            font-family: 'MinhaFonte';
            src: url('img-fontes/the_wild_breath_of_zelda/The Wild Breath of Zelda.otf') format('truetype');
            }
        body{
            font-family: 'MinhaFonte', sans-serif;
            display:flexbox;
            justify-content: center;
            justify-items: center;
            align-items: end;
            min-height: 100vh;
            min-width: auto;
            background-image: url('img-fontes/background.jpeg'); /* Caminho da imagem */
            background-size: cover; /* Faz a imagem cobrir toda a tela */
            background-position: center; /* Centraliza a imagem */
            background-attachment: fixed; /* Mantém a imagem fixa ao rolar a página */
            border-radius: 5px;
            margin-top: 0;


            h1{

                color: rgb(0, 0, 0);

            }
        }
        .menu{
            background-position: center;
            background-image: url(https://i.pinimg.com/474x/ab/12/ae/ab12ae552f86953ff2d2616989941155--d-texture-texture-painting.jpg);
            color: black;
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
         
            a{
                margin: 5px;
                color: aquamarine;
               
            }
        }
        .navbar {
            background:rgba(0, 0, 0, 0.45);
            padding: 10px;
            width: 100%;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }
        .inventario {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            padding: 20px;
            max-width: 600px;
            margin: auto;
            background:rgba(0, 0, 0, 0.37);
            border: 5px solid black;
            border-radius: 10px;
        }
        .item {
            background: #fff;
            border: 2px solid rgb(0, 0, 0);
            padding: 10px;
            border-radius: 5px;
        }
        .item img {
            width: 50px;
            height: 50px;
        }
        .menu {
            margin-top: 20px;
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
session_start();



// Arquivo onde os itens estão armazenados
$arquivo = 'itens.txt';
$itens = [];

if (file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES);
    foreach ($linhas as $linha) {
        list($nome, $quantidade, $imagem) = explode('|', $linha);
        $itens[] = [
            'nome' => $nome,
            'quantidade' => $quantidade,
            'imagem' => $imagem
        ];
    }
}
?>
<body>
    <h1>Inventario</h1>
    <div class="inventario">
        <?php foreach ($itens as $item) { ?>
            <div class="item">
                <img src="<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>">
                <p><?php echo htmlspecialchars($item['nome']); ?></p>
                <p>Quantidade: <?php echo htmlspecialchars($item['quantidade']); ?></p>
            </div>
        <?php } ?>
    </div>
</body>
    
</body>
</html>