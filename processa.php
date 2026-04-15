<?php
// 1. Configurações de conexão (Ajuste conforme seu ambiente local)
$host = "localhost";
$db   = "nexus_data";
$user = "root";
$pass = ""; // No XAMPP geralmente é vazio

try {
    // Conexão via PDO (mais seguro e moderno)
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Verifica se o formulário foi enviado via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Recebe e sanitiza os dados
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $servico = filter_input(INPUT_POST, 'servico', FILTER_SANITIZE_SPECIAL_CHARS);
        $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);

        // 3. Prepara a Query SQL
        $sql = "INSERT INTO contatos (nome, email, servico, mensagem) VALUES (:nome, :email, :servico, :mensagem)";
        $stmt = $pdo->prepare($sql);

        // 4. Vincula os parâmetros e executa
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':servico', $servico);
        $stmt->bindParam(':mensagem', $mensagem);

        if ($stmt->execute()) {
            // Sucesso: Redireciona ou mostra mensagem
            echo "<script>alert('Obrigado, $nome! Seu pedido foi enviado com sucesso.'); window.location.href='index.html';</script>";
        } else {
            echo "Erro ao enviar os dados.";
        }
    }

} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>