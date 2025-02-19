<?php
include_once '../dao/EdicaoDao.php';
include_once '../dao/LivroDAO.php';

$edicaoDAO = new EdicaoDao();
$livroDAO = new LivroDAO();

// Verifica se existe um ID de edição para edição
$edicaoEdit = null;
if (isset($_GET['edit_id'])) {
    $edicoes = $edicaoDAO->listar();
    foreach ($edicoes as $edicao) {
        if ($edicao['id'] == $_GET['edit_id']) {
            $edicaoEdit = $edicao;
            break;
        }
    }
}

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

    <h2><?= isset($edicaoEdit) ? 'Editar Edição Especial' : 'Cadastro de Edição Especial' ?></h2>

    <!-- Formulário de Cadastro / Edição -->
    <form action="../controllers/EdicaoController.php" method="POST" class="mb-4">
        <input type="hidden" name="id" value="<?= isset($edicaoEdit) ? $edicaoEdit['id'] : '' ?>">

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3" maxlength="255"
                required><?= isset($edicaoEdit) ? htmlspecialchars($edicaoEdit['descricao']) : '' ?></textarea>
        </div>


        <div class="mb-3">
            <label for="livro_id" class="form-label">Livro:</label>
            <select name="livro_id" id="livro_id" class="form-control" required>
                <option value="">Selecione um livro</option>
                <?php
                $livros = $livroDAO->listar();
                foreach ($livros as $livro) {
                    // Verificar se o livro está selecionado
                    $selected = isset($edicaoEdit) && $edicaoEdit['livro_id'] == $livro->id ? 'selected' : '';
                    echo "<option value='{$livro->id}' {$selected}>{$livro->titulo} - {$livro->autor_nome}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="action" value="<?= isset($edicaoEdit) ? 'editar' : 'cadastrar' ?>"
            class="btn btn-primary">
            <?= isset($edicaoEdit) ? 'Salvar Alterações' : 'Cadastrar' ?>
        </button>
    </form>

    <!-- Mensagens de status (sucesso/erro) -->
    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-<?= $_GET['status'] ?>" role="alert">
            <?= isset($_GET['message']) ? $_GET['message'] : 'Operação realizada com sucesso!' ?>
        </div>
    <?php endif; ?>

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
                    <td class="descricao"><?= $edicao['descricao'] ?></td>
                    <td><?= $edicao['livro_nome'] ?></td>
                    <td>
                        <a href="?edit_id=<?= $edicao['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form action="../controllers/EdicaoController.php" method="POST" style="display:inline-block;">
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