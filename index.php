<?php
require_once 'includes/db.php'; 
require_once 'functions/get_aviso.php';

// Consulta para pegar os dados de todos os corretores.
$sql = "SELECT * FROM corretores";
$result = mysqli_query($mysql, $sql);

// Verifica se há resultados e gera as linhas da tabela
$tabelaCorretores = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tabelaCorretores .= "<tr>";
        $tabelaCorretores .= "<td>" . htmlspecialchars($row['nome']) . "</td>";
        $tabelaCorretores .= "<td>" . htmlspecialchars($row['cpf']) . "</td>";
        $tabelaCorretores .= "<td>" . htmlspecialchars($row['creci']) . "</td>";
        $tabelaCorretores .= "<td class='d-flex justify-content-center'>
                                <a href='editar.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm me-2'>Editar</a>
                                <a href='functions/excluir.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                              </td>";
        $tabelaCorretores .= "</tr>";
    }
} else {
    $tabelaCorretores = "<tr><td colspan='4' class='text-center'>Nenhum corretor cadastrado.</td></tr>";
}

// Recupera o aviso e o tipo de alerta
$avisoData = get_aviso();
$aviso = $avisoData['aviso'];
$alert = $avisoData['alert'];
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Cadastro de Corretor</title>
</head>
<body>
    <!-- Alertas -->
    <?php require_once 'includes/avisos.php' ?>
    
    <!-- Título -->
     <a href="index.php" class="text-decoration-none text-dark">
        <h2 class="fw-bold text-center mt-4">Cadastro de Corretor</h2>
     </a>

    <!-- Formulário -->
    <form class="form container mx-auto mt-3" action="includes/cadastro.php" method="post" novalidate>
        <div class="mb-3 row">
            <div class="col-5">
                <div class="form-floating-label">
                    <input type="text" name="cpf" class="form-control" id="inputCpf" placeholder=" " required>
                    <label for="inputCpf">Digite seu CPF</label>
                    <span class="error-message" id="cpfError"></span>
                </div>
            </div>
            <div class="col-7">
                <div class="form-floating-label">
                    <input type="text" name="creci" class="form-control" id="inputCreci" placeholder=" " required>
                    <label for="inputCreci">Digite seu Creci</label>
                    <span class="error-message" id="creciError"></span>
                </div>
            </div>
        </div>

        <div class="mb-3 form-floating-label">
            <input type="text" name="nome" class="form-control" id="inputName" placeholder=" " required>
            <label for="inputName">Digite seu nome</label>
            <span class="error-message" id="nameError"></span>
        </div>

        <button type="submit" class="btn btn-secondary w-100 text-align-center">Enviar</button>
    </form>

    <!-- Tabela de Corretores -->
    <div class="container mx-auto mt-5">
        <h3 class="text-center">Corretores Cadastrados</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>CRECI</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php print $tabelaCorretores; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <?php require_once 'includes/modal.php' ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/index.js"></script>
</html>
