<?php
$host = 'localhost';  // Servidor local
$dbname = 'lista_tarefa';  // Nome do banco de dados
$username = 'root';  // Usuário do MySQL
$password = '';  // Senha do MySQL (geralmente em branco no XAMPP)

try {
    // Tenta conectar ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Definindo modo de erro
    echo "Conexão bem-sucedida!";  // Mensagem de sucesso
} catch (PDOException $e) {
    // Se falhar, exibe o erro
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}
?>
