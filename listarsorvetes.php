<?php
$mysqli = new mysqli("localhost", "root", "", "sorveteria");

if ($mysqli->connect_error) {
    die("Conexão falhou: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT nome, preco, quantidade FROM sorvetes");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Sorvetes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Sorvetes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $totalQuantidade = 0;
            $totalGeral = 0;

            while ($row = $result->fetch_assoc()) {
                $subtotal = $row['preco'] * $row['quantidade'];
                echo "<tr>
                <td>{$row['nome']}</td>
                <td>R$ {$row['preco']}</td>
                <td>{$row['quantidade']}</td>
                <td>R$ $subtotal</td>
                </tr>";
                
                $totalQuantidade += $row['quantidade'];
                $totalGeral += $subtotal;
            }

            echo "<tr><td colspan='2'>Quantidade Total</td><td>$totalQuantidade</td><td></td></tr>";
            echo "<tr><td colspan='3'>Total Geral</td><td>R$ $totalGeral</td></tr>";
            ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary">Voltar para o Menu</a>
    </div>

<?php
$mysqli->close();
?>
</body>
</html>