<?php
require_once '../includes/db.php';
require 'formatar_mensagem.php';

// Verifica se o ID foi passado na URL
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para excluir o corretor com o ID fornecido
    $sql = "DELETE FROM corretores WHERE id = {$id}";

    // Executa a consulta
    if (mysqli_query($mysql, $sql)) {
        $aviso .= 'Cadastro excluído com sucesso.';
        $avisoFormatado = formatar_mensagem($aviso);
        header("Location: ../index.php?success=1&aviso=" . urlencode($avisoFormatado));
    } else {
        echo "Erro ao excluir: " . mysqli_error($mysql);
    }

    mysqli_close($mysql);
} else {
    echo "ID não fornecido!";
}
