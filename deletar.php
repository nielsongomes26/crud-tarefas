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

// Verificar se o ID foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao deletar tarefa: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
