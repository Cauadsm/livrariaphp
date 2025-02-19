<?php
include_once '../dao/AutorDAO.php';

$autorDAO = new AutorDAO();
$autores = $autorDAO->listar();

$autorEdit = null;
if (isset($_GET['edit_id'])) {
    $autorEdit = $autorDAO->listar();
    foreach ($autorEdit as $autor) {
        if ($autor['id'] == $_GET['edit_id']) {
            $autorEdit = $autor;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Autores</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="container mt-4">
    <div class="position-absolute" style="top: 10px; left: 10px;">
        <a href="../index.php" class="btn btn-secondary">Voltar para a Home</a>
    </div>

    <h2><?= isset($autorEdit['id']) ? 'Editar Autor' : 'Cadastro de Autor' ?></h2>
    <form action="../controllers/AutorController.php" method="POST" class="mb-4">
        <input type="hidden" name="id" value="<?= isset($autorEdit['id']) ? $autorEdit['id'] : '' ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Autor:</label>
            <input type="text" name="nome" id="nome" class="form-control"
                value="<?= isset($autorEdit['nome']) ? $autorEdit['nome'] : '' ?>" required>
        </div>
        <button type="submit" name="action" value="<?= isset($autorEdit['id']) ? 'editar' : 'cadastrar' ?>"
            class="btn btn-primary">
            <?= isset($autorEdit['id']) ? 'Salvar Alterações' : 'Cadastrar' ?>
        </button>
    </form>

    <!-- Mensagens de status (sucesso/erro) -->
    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-<?= $_GET['status'] ?>" role="alert">
            <?= isset($_GET['message']) ? $_GET['message'] : 'Operação realizada com sucesso!' ?>
        </div>
    <?php endif; ?>

    <h2>Lista de Autores</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?= $autor['id'] ?></td>
                    <td><?= $autor['nome'] ?></td>
                    <td>
                        <a href="?edit_id=<?= $autor['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="../controllers/AutorController.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $autor['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>