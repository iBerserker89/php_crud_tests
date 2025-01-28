<?php
require 'db.php';
require '../functions/formatar_mensagem.php';
require '../functions/valida_dados.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($mysql, trim($_POST['nome']));
    $cpf = mysqli_real_escape_string($mysql, trim($_POST['cpf']));
    $creci = mysqli_real_escape_string($mysql, trim($_POST['creci']));
    
    $aviso = valida_dados($nome, $cpf, $creci );

    // Verifica se o CPF já existe no banco de dados.
    if (mysqli_num_rows(consulta_dados("
            SELECT cpf 
            FROM corretores
            WHERE cpf = '{$cpf}'
        ")) > 0) {
        $aviso .= 'CPF já cadastrado.';
    }

    // Verifica se o CRECI já existe no banco de dados.
    if (mysqli_num_rows(consulta_dados("
            SELECT creci 
            FROM corretores
            WHERE creci = '{$creci}'
        ")) > 0) {
        $aviso .= 'CRECI já cadastrado.';
    }

    if (!empty($aviso)) {
        $avisoFormatado = formatar_mensagem($aviso);
        header("Location: ../index.php?error=1&aviso=" . urlencode($avisoFormatado));
    } else {
        // Insere os dados na tebela.
        $stmt = $mysql->prepare("INSERT INTO corretores (nome, cpf, creci) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $nome, $cpf, $creci);

        if ($stmt->execute()) {
            $stmt->close();
            $mysql->close();
            $aviso .= 'Cadastro realizado com sucesso!';
            $avisoFormatado = formatar_mensagem($aviso);
            header("Location: ../index.php?success=1&aviso=" . urlencode($avisoFormatado));
        } else {
            echo "Erro ao cadastrar: " . $mysql->error;
            $stmt->close();
            $mysql->close();
        }
    }
}
