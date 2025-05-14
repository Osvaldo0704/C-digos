<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Itens</title>
    <link rel="shortcut icon" href="img-fontes/favicon/favicon-32x32.png" type="image/x-icon">

    <style>
        @font-face {
            font-family: 'MinhaFonte';
            src: url('img-fontes/the_wild_breath_of_zelda/The Wild Breath of Zelda.otf') format('truetype');
        }
        h2{
            margin-top: 200px;
        }
        body{
            font-family: 'MinhaFonte', sans-serif;
            justify-content: center;
            justify-items: center;
            align-items: center;
            min-height: 100vh;
            min-width: auto;
            background-image: url('img-fontes/background.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            border-radius: 5px;
            margin-top: 0;
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
            font-size: larger;
            border-radius: 10px;
            padding: 5px;
            height: 200px;
            width: 200px;
            border: 5px solid;
        }
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
        .tela{
            background-color:rgba(0, 0, 0, 0.47);
            border-radius: 10px;
            border: solid black;
            padding: 10px;
        }
        .titulo{
            align-items: center;
            justify-content: center;
            justify-items: center;
        }
    </style>
</head>
<body>
<?php
session_start();

// Dados da conexão (ajuste conforme necessário)
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "inventario";

// Conectar ao banco
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $quantidade = (int)trim($_POST['quantidade']);
    $imagem = trim($_POST['imagem']);

    if (!empty($nome) && !empty($descricao) && $quantidade > 0 && !empty($imagem)) {
        // Verifica se item já existe
        $stmt = $conn->prepare("SELECT ID, qtd_item FROM item WHERE nome_item = ?");
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Atualiza quantidade se item já existir
            $linha = $resultado->fetch_assoc();
            $novaQuantidade = $linha['qtd_item'] + $quantidade;

            $stmt = $conn->prepare("UPDATE item SET qtd_item = ?, descricao_item = ?, img_item = ? WHERE ID = ?");
            $stmt->bind_param("issi", $novaQuantidade, $descricao, $imagem, $linha['ID']);
            $stmt->execute();

            $mensagem = "Quantidade atualizada com sucesso!";
        } else {
            // Insere novo item
            $stmt = $conn->prepare("INSERT INTO item (nome_item, qtd_item, descricao_item, img_item) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siss", $nome, $quantidade, $descricao, $imagem);
            $stmt->execute();

            $mensagem = "Item cadastrado com sucesso!";
        }
        $stmt->close();
    } else {
        $mensagem = "Preencha todos os campos corretamente.";
    }

    $conn->close();
}
?>
    <div class="navbar">
        <a href="index.php">Menu</a>
        <a href="cadastro.php">Cadastro de Itens</a>
        <a href="inventario.php">Inventario</a>
    </div>
    <div class="titulo">
        <h2>Cadastro de Itens</h2>
        <div class="tela">
            <?php if (isset($mensagem)) { ?>
                <div class="alert alert-info"> <?php echo $mensagem; ?> </div>
            <?php } ?>
            <form action="cadastro.php" method="post">
                <div>
                    <label for="nome" class="form-label"></label>
                    <input type="text" placeholder="Nome do Item:" class="form-control" id="nome" name="nome" required>
                </div>
                <div>
                    <label for="descricao" class="form-label"></label>
                    <input type="text" placeholder="Descrição do Item:" class="form-control" id="descricao" name="descricao" required>
                </div>
                <div>
                    <label for="quantidade" class="form-label"></label>
                    <input type="number" placeholder="Quantidade:" class="form-control" id="quantidade" name="quantidade" required>
                </div>
                <div>
                    <label for="imagem" class="form-label"></label>
                    <input type="url" placeholder="URL da Imagem:" class="form-control" id="imagem" name="imagem" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>