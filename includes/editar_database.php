<?php
require 'db.php';
require '../functions/formatar_mensagem.php';
require '../functions/valida_dados.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = mysqli_real_escape_string($mysql, trim($_POST['nome']));
    $cpf = mysqli_real_escape_string($mysql, trim($_POST['cpf']));
    $creci = mysqli_real_escape_string($mysql, trim($_POST['creci']));
    
    $aviso = valida_dados($nome, $cpf, $creci );

    if (!empty($aviso)) {
        $avisoFormatado = formatar_mensagem($aviso);
        header("Location: ../editar.php?id={$id}&aviso=" . urlencode($avisoFormatado));
    } else {
        // Atualiza os dados na tabela.
        $stmt = $mysql->prepare("UPDATE corretores SET nome = ?, cpf = ?, creci = ? WHERE id = ?");
        $stmt->bind_param('sssi', $nome, $cpf, $creci, $id);

        if ($stmt->execute()) {
            $stmt->close();
            $mysql->close();
            $aviso .= 'Cadastro atualizado com sucesso.';
            $avisoFormatado = formatar_mensagem($aviso);
            header("Location: ../index.php?success=1&aviso=" . urlencode($avisoFormatado));
        } else {
            echo "Erro ao atualizar: " . $mysql->error;
            $stmt->close();
            $mysql->close();
        }
    }  
}
