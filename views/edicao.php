<?php
include_once '../dao/EdicaoDao.php';

$edicaoDAO = new EdicaoDao();
$edicoes = $edicaoDAO->listar();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Edições Especiais</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        /* Limitar a largura da coluna de descrição */
        td.descricao {
            max-width: 250px;
            /* Ajuste o tamanho conforme necessário */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body class="container mt-4">

    <!-- Botão para voltar para a Home -->
    <div class="position-absolute" style="top: 10px; left: 10px;">
        <a href="../index.php" class="btn btn-secondary">Voltar para a Home</a>
    </div>

    <h2>Cadastro de Edição Especial</h2>
    <form action="../controllers/EdicaoController.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3" maxlength="255" required></textarea>
        </div>

        <div class="mb-3">
            <label for="livro_id" class="form-label">Livro:</label>
            <select name="livro_id" id="livro_id" class="form-control" required>
                <option value="">Selecione um livro</option>
                <?php
                include_once '../dao/LivroDAO.php';
                $livroDAO = new LivroDAO();
                $livros = $livroDAO->listar();

                if (!empty($livros)) { // Verifica se há livros cadastrados
                    foreach ($livros as $livro) {
                        echo "<option value='{$livro->id}'>{$livro->titulo} - {$livro->autor_nome}</option>";
                    }
                } else {
                    echo "<option value='' disabled>Nenhum livro encontrado</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

    <h2>Lista de Edições Especiais</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Livro</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($edicoes as $edicao): ?>
                <tr>
                    <td><?= $edicao['id'] ?></td>
                    <!-- Aplicando a classe 'descricao' para controlar a largura e o overflow -->
                    <td class="descricao"><?= $edicao['descricao'] ?></td>
                    <td><?= $edicao['livro_nome'] ?></td>
                    <td>
                        <form action="../controllers/EdicaoController.php" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $edicao['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>