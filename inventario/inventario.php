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

        body {
            font-family: 'MinhaFonte', sans-serif;
            min-height: 100vh;
            background-image: url('img-fontes/background.jpeg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
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

        h1 {
            text-align: center;
            color: white;
            margin-top: 30px;
        }

        .inventario {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            padding: 20px;
            max-width: 1000px;
            margin: auto;
            background: rgba(0, 0, 0, 0.37);
            border: 5px solid black;
            border-radius: 10px;
        }

        .item {
            background: #fff;
            border: 2px solid rgb(0, 0, 0);
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            position: relative; /* Necessário para o posicionamento absoluto dos botões */
            height: 225px; /* Ajuste o tamanho da div conforme necessário */
        }

        .item img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .item p {
            margin: 5px;
        }

        .botao {
            position: absolute;
            bottom: 10px; /* Fixa os botões na parte inferior */
            left: 50%;
            transform: translateX(-50%); /* Centraliza os botões horizontalmente */
            display: flex;
            justify-content: center;
            gap: 10px; /* Espaçamento entre os botões */
        }

        .botao a {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .botao .editar {
            background-color: #007bff;
        }

        .botao .excluir {
            background-color: #dc3545;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Menu</a>
        <a href="cadastro.php">Cadastro de Itens</a>
        <a href="inventario.php">Inventario</a>
    </div>

    <h1>Inventário</h1>

    <div class="inventario">
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

            // Verifica se foi solicitado excluir um item
            if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
                $id = (int)$_GET['delete'];

                // Exclui o item
                $stmt = $conn->prepare("DELETE FROM item WHERE ID = ?");
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    // Exibe uma mensagem de sucesso
                    echo '<div class="mensagem">Item excluído com sucesso!</div>';
                } else {
                    // Exibe uma mensagem de erro se a exclusão falhar
                    echo '<div class="mensagem">Erro ao excluir item. Tente novamente.</div>';
                }

                // Fecha a declaração e a conexão
                $stmt->close();
            }

        $sql = "SELECT ID, nome_item, qtd_item, descricao_item, img_item FROM item";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($item = $resultado->fetch_assoc()) {
                echo '<div class="item">';
                echo '<img src="' . htmlspecialchars($item["img_item"]) . '">';
                echo '<p><strong>' . htmlspecialchars($item["nome_item"]) . '</strong></p>';
                echo '<p>' . htmlspecialchars($item["descricao_item"]) . '</p>';
                echo '<p>Quantidade: ' . htmlspecialchars($item["qtd_item"]) . '</p>';
                echo '<div class="botao">';
                echo '<a href="editar_item.php?id=' . $item["ID"] . '" style="display:inline-block;margin-top:5px;padding:5px 10px;background-color:#007bff;color:white;border-radius:5px;text-decoration:none;">Editar</a>';
                echo ' <a href="?delete=' . $item["ID"] . '" style="display:inline-block;margin-top:5px;padding:5px 10px;background-color:#dc3545;color:white;border-radius:5px;text-decoration:none;">Excluir</a>';
                echo '</div>';
                echo '</div>';
                
            }
        } else {
            echo '<p style="color:white; text-align:center;">Nenhum item cadastrado.</p>';
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
