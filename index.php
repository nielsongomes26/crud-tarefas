<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'lista_tarefa';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Buscar as tarefas no banco
$sql = "SELECT * FROM tarefas";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Tarefas</h1>
        <form action="adicionar.php" method="POST" class="mt-4">
            <div class="input-group">
                <input type="text" name="descricao" class="form-control" placeholder="Nova tarefa" required>
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </form>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Concluída</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['descricao']) ?></td>
                        <td><?= $row['concluido'] ? 'Sim' : 'Não' ?></td>
                        <td>
                            <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="deletar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Deletar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
