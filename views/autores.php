<?php
include_once '../dao/AutorDAO.php';

$autorDAO = new AutorDAO();
$autores = $autorDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Autores</title>
    <!-- Importando fonte moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="container mt-4">

    <!-- Botão para voltar para a Home -->
    <div class="position-absolute" style="top: 10px; left: 10px;">
        <a href="../index.php" class="btn btn-secondary">Voltar para a Home</a>
    </div>

    <h2>Cadastro de Autor</h2>
    <form action="../controllers/AutorController.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Autor:</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <h2>Lista de Autores</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($autores as $autor): ?>
                <tr>
                    <td><?= $autor['id'] ?></td>
                    <td><?= $autor['nome'] ?></td>
                    <td>
                        <form action="../controllers/AutorController.php" method="POST">
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