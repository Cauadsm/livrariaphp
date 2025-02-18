<?php
include_once '../dao/LivroDAO.php';
include_once '../dao/AutorDAO.php';

$livroDAO = new LivroDAO();
$autorDAO = new AutorDAO();
$livros = $livroDAO->listar();
$autores = $autorDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Livros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">

    <h2>Cadastro de Livro</h2>
    <form action="../controllers/LivroController.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Livro:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="autor_id" class="form-label">Autor:</label>
            <select name="autor_id" id="autor_id" class="form-control" required>
                <option value="">Selecione um autor</option>
                <?php foreach ($autores as $autor): ?>
                    <option value="<?= $autor['id'] ?>"><?= $autor['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

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
                    <td><?= $livro['id'] ?></td>
                    <td><?= $livro['titulo'] ?></td>
                    <td><?= $livro['autor_nome'] ?></td>
                    <td>
                        <form action="../controllers/LivroController.php" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                      

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>