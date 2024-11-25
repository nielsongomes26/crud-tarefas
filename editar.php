<?php

include 'config.php';


$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'lista_tarefa';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT * FROM tarefas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tarefa = $result->fetch_assoc();
    } else {
        echo "Tarefa não encontrada!";
        exit;
    }

    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $concluido = isset($_POST['concluido']) ? 1 : 0;

    $sql = "UPDATE tarefas SET descricao = ?, concluido = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sii', $descricao, $concluido, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao atualizar tarefa: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Tarefa</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?= htmlspecialchars($tarefa['descricao']) ?>" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="concluido" name="concluido" <?= $tarefa['concluido'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="concluido">Concluído</label>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
