<?php
include_once '../dao/LivroDAO.php';
include_once '../dao/AutorDAO.php';

$livroDAO = new LivroDAO();
$autorDAO = new AutorDAO();

// Lista de livros com autores
$livros = $livroDAO->listar();

// Lista de autores para o campo de seleção ao cadastrar um livro
$autores = $autorDAO->listar();

// Verificar se existe um livro para edição
$livroEdit = null;
if (isset($_GET['edit_id'])) {
    $livroEdit = null;
    foreach ($livros as $livro) {
        if ($livro->id == $_GET['edit_id']) {
            $livroEdit = $livro;
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
    <title>Gerenciar Livros</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="container mt-4">

    <!-- Botão para voltar para a Home-->
    <div class="position-absolute" style="top: 10px; left: 10px;">
        <a href="../index.php" class="btn btn-secondary">Voltar para a Home</a>
    </div>

    <h2><?= isset($livroEdit) ? 'Editar Livro' : 'Cadastro de Livro' ?></h2>
    <form action="../controllers/LivroController.php" method="POST" class="mb-4">
        <input type="hidden" name="id" value="<?= isset($livroEdit) ? $livroEdit->id : '' ?>">
        
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Livro:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= isset($livroEdit) ? $livroEdit->titulo : '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="autor_id" class="form-label">Autor:</label>
            <select name="autor_id" id="autor_id" class="form-select" required>
                <option value="">Selecione o Autor</option>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['id'] ?>" <?= isset($livroEdit) && $livroEdit->autor_id == $autor['id'] ? 'selected' : '' ?>>
                        <?= $autor['nome'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="action" value="<?= isset($livroEdit) ? 'editar' : 'cadastrar' ?>" class="btn btn-primary">
            <?= isset($livroEdit) ? 'Salvar Alterações' : 'Cadastrar' ?>
        </button>
    </form>

    <!-- Mensagens de status (sucesso/erro) -->
    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-<?= $_GET['status'] ?>" role="alert">
            <?= isset($_GET['message']) ? $_GET['message'] : 'Operação realizada com sucesso!' ?>
        </div>
    <?php endif; ?>

    <h2>Lista de Livros</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($livros as $livro): ?>
                <tr>
                    <td><?= $livro->id ?></td>
                    <td><?= $livro->titulo ?></td>
                    <td><?= $livro->autor_nome ?></td>
                    <td>
                        <a href="?edit_id=<?= $livro->id ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="../controllers/LivroController.php" method="POST" style="display:inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $livro->id ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>
