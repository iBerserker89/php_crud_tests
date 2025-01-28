<?php
require_once 'includes/db.php';
require_once 'functions/get_aviso.php';

// Verifica se o ID foi passado na URL
if (!empty($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obter os dados do corretor com o ID fornecido
    $sql = "SELECT * FROM corretores WHERE id = {$id}";
    $result = mysqli_query($mysql, $sql);

    // Verifica se o corretor existe
    if (mysqli_num_rows($result) == 0) {
        echo "Corretor não encontrado!";
    }

    $corretor = mysqli_fetch_assoc($result);
} else {
    echo "ID não fornecido!";
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
    <link rel="stylesheet" href="./assets/style/style.css">
    <title>Editar Corretor</title>
</head>
<body>

    <!-- Alertas -->
    <?php require_once 'includes/avisos.php' ?>

    <!-- Título -->
    <a href="index.php" class="text-decoration-none text-dark">
        <h2 class="fw-bold text-center mt-4">Editar Corretor</h2>
    </a>
    <!-- Formulário de edição -->
    <form class="form container mx-auto mt-3" action="includes/editar_database.php" method="post">
        <input type="hidden" name="id" value="<?= $corretor['id'] ?>">

        <div class="mb-3 row">
            <div class="col-5">
                <div class="form-floating-label">
                    <input type="text" name="cpf" class="form-control" id="inputCpf" value="<?= htmlspecialchars($corretor['cpf']) ?>" required>
                    <label for="inputCpf">Digite seu CPF</label>
                </div>
            </div>
            <div class="col-7">
                <div class="form-floating-label">
                    <input type="text" name="creci" class="form-control" id="inputCreci" value="<?= htmlspecialchars($corretor['creci']) ?>" required>
                    <label for="inputCreci">Digite seu Creci</label>
                </div>
            </div>
        </div>

        <div class="mb-3 form-floating-label">
            <input type="text" name="nome" class="form-control" id="inputName" value="<?= htmlspecialchars($corretor['nome']) ?>" required>
            <label for="inputName">Digite seu nome</label>
        </div>

        <button type="submit" class="btn btn-secondary w-100">Salvar</button>
    </form>

    <!-- Modal -->
    <?php require_once 'includes/modal.php' ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/index.js"></script>
</html>
