<?php
session_start();

// Dados de conexão
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "inventario";

// Conectar ao banco
$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o ID foi passado pela URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID do item inválido.");
}

$id = (int)$_GET['id'];
$mensagem = "";

// Processar o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $quantidade = (int)$_POST['quantidade'];
    $imagem = trim($_POST['imagem']);

    if ($nome && $descricao && $quantidade > 0 && $imagem) {
        $stmt = $conn->prepare("UPDATE item SET nome_item = ?, qtd_item = ?, descricao_item = ?, img_item = ? WHERE ID = ?");
        $stmt->bind_param("sissi", $nome, $quantidade, $descricao, $imagem, $id);
        if ($stmt->execute()) {
            $mensagem = "Item atualizado com sucesso!";
        } else {
            $mensagem = "Erro ao atualizar item.";
        }
        $stmt->close();
    } else {
        $mensagem = "Preencha todos os campos corretamente.";
    }
}

// Buscar dados do item
$stmt = $conn->prepare("SELECT * FROM item WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$item = $resultado->fetch_assoc();

if (!$item) {
    die("Item não encontrado.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('img-fontes/background.jpeg');
            background-size: cover;
            background-attachment: fixed;
            color: white;
            padding: 30px;
        }
        .container {
            background-color: rgba(0,0,0,0.6);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background: #007BFF;
            color: white;
            cursor: pointer;
        }
        .mensagem {
            background: #fff;
            color: black;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
        }
        a {
            color: #00f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Item</h2>
        <?php if ($mensagem): ?>
            <div class="mensagem"><?php echo $mensagem; ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <label>Nome do Item:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($item['nome_item']); ?>" required>

            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?php echo htmlspecialchars($item['descricao_item']); ?>" required>

            <label>Quantidade:</label>
            <input type="number" name="quantidade" value="<?php echo htmlspecialchars($item['qtd_item']); ?>" required>

            <label>URL da Imagem:</label>
            <input type="url" name="imagem" value="<?php echo htmlspecialchars($item['img_item']); ?>" required>

            <button type="submit">Salvar Alterações</button>
        </form>
        <p><a href="inventario.php">← Voltar para o Inventário</a></p>
    </div>
</body>
</html>
