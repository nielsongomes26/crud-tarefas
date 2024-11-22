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

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];

    // Inserir no banco de dados
    $sql = "INSERT INTO tarefas (descricao, concluido) VALUES (?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $descricao);

    if ($stmt->execute()) {
        header('Location: index.php'); // Redirecionar para o index
        exit;
    } else {
        echo "Erro ao adicionar tarefa: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
