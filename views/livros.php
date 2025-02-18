<?php
include_once '../dao/LivroDAO.php';
include_once '../dao/AutorDAO.php';

$livroDAO = new LivroDAO();
$livros = $livroDAO->listar();

// Suponhamos que você queira listar os autores para escolher um ao cadastrar o livro
$autorDAO = new AutorDAO();
$autores = $autorDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Livros</title>
    <!-- Importando fonte moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body class="container mt-4">

    <!-- Botão para voltar para a Home-->
    <div class="position-absolute" style="top: 10px; left: 10px;">
        <a href="../index.php" class="btn btn-secondary">Voltar para a Home</a>
    </div>

    <h2>Cadastro de Livro</h2>
    <form action="../controllers/LivroController.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título do Livro:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="autor_id" class="form-label">Autor:</label>
            <select name="autor_id" id="autor_id" class="form-select" required>
                <option value="">Selecione o Autor</option>
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
                    <td><?= $livro->id ?></td> <!-- Acessando a propriedade id como um objeto -->
                    <td><?= $livro->titulo ?></td> <!-- Acessando a propriedade titulo como um objeto -->
                    <td><?= $livro->autor_nome ?></td> <!-- Acessando a propriedade autor_nome como um objeto -->
                    <td>
                        <form action="../controllers/LivroController.php" method="POST">
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