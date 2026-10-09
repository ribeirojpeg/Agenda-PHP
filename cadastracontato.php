<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = trim($_POST["nome"]);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $favorito = isset($_POST['favorito']) ? 0 : 1;
    
    $erros = [];

    if (empty($nome)) {
        $erros[] = "Erro: o campo nome precisa ser preenchido.";
    }
    if (empty($telefone)) {
        $erros[] = "Erro: o campo telefone precisa ser preenchido.";
    }

    if (empty($erros)) {
        $sql = "INSERT INTO contatos (nome, telefone, email, favorito)
                VALUES (:nome, :telefone, :email, :favorito)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nome" => $nome,
            ":telefone" => $telefone,
            ":email" => $email,
            ":favorito" => $favorito,
        ]);

        header("Location:index.php");
    } else {
        foreach ($erros as $erro){
            echo $erro;
        }
}
?>