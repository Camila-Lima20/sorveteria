<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Quantidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Atualizar Quantidades de Sorvete</h1>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $quantidade = $_POST['quantidade'];

            $mysqli = new mysqli("localhost", "root", "", "sorveteria");
            
            if ($mysqli->connect_error) {
                die("Conexão falhou: " . $mysqli->connect_error);
            }

            $stmt = $mysqli->prepare("UPDATE sorvetes SET quantidade = ? WHERE nome = ?");
            $stmt->bind_param("is", $quantidade, $nome);
            
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Quantidade atualizada com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao atualizar quantidade: " . $stmt->error . "</div>";
            }

            $stmt->close();
            $mysqli->close();
        }
        ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="nome" class='form-label'>Nome do Sorvete:</label>
                <input type='text' name='nome' id='nome' required class='form-control'/>
            </div>

            <div class="mb-3">
                <label for="quantidade" class='form-label'>Nova Quantidade:</label>
                <input type='number' name='quantidade' id='quantidade' required class='form-control'/>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Quantidade</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-3">Voltar para o Menu</a>
    </div>
</body>
</html>