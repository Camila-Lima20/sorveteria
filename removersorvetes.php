<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Sorvete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Remover Sorvete</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];

            $mysqli = new mysqli("localhost", "root", "", "sorveteria");
            
            if ($mysqli->connect_error) {
                die("Conexão falhou: " . $mysqli->connect_error);
            }

            $stmt = $mysqli->prepare("DELETE FROM sorvetes WHERE nome = ?");
            $stmt->bind_param("s", $nome);
            
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Sorvete removido com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao remover sorvete: " . $stmt->error . "</div>";
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

            <button type="submit" class="btn btn-danger">Remover Sorvete</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Voltar para o Menu</a>
    </div>
</body>
</html>