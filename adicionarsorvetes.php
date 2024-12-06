<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Sorvete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Sorvete</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $preco = $_POST['preco'];
            $quantidade = $_POST['quantidade'];

            $mysqli = new mysqli("localhost", "root", "", "sorveteria");
            
            if ($mysqli->connect_error) {
                die("Conexão falhou: " . $mysqli->connect_error);
            }

            $stmt = $mysqli->prepare("INSERT INTO sorvetes (nome, preco, quantidade) VALUES (?, ?, ?)");
            $stmt->bind_param("sdi", $nome, $preco, $quantidade);
            
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Sorvete adicionado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao adicionar sorvete: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $mysqli->close();
        }
        ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="preco" class="form-label">Preço:</label>
                <input type="number" step="0.01" name="preco" id="preco" class="form-control" required />
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-primary">Adicionar Sorvete</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Voltar para o Menu</a>
    </div>
</body>
</html>