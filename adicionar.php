<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'lista_tarefa';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];

    
    $sql = "INSERT INTO tarefas (descricao, concluido) VALUES (?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $descricao);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao adicionar tarefa: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
