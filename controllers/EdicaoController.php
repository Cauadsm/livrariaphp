<?php
include_once '../dao/EdicaoDao.php';
include_once '../dao/LivroDAO.php';

$edicaoDAO = new EdicaoDao();
$livroDAO = new LivroDAO();

// Verificando se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verificando se os campos obrigatórios estão preenchidos
    if (isset($_POST['descricao'], $_POST['livro_id']) && !empty($_POST['descricao']) && is_numeric($_POST['livro_id']) && $_POST['livro_id'] > 0) {
        $descricao = $_POST['descricao'];
        $livro_id = $_POST['livro_id'];

        // Se o ID da edição estiver presente, significa edição
        if (!empty($_POST['id'])) {
            $edicao = new Edicao();
            $edicao->id = $_POST['id'];
            $edicao->descricao = $descricao;
            $edicao->livro_id = $livro_id;

            $resultado = $edicaoDAO->editar($edicao);
        } else { // Caso contrário, é cadastro
            $edicao = new Edicao();
            $edicao->descricao = $descricao;
            $edicao->livro_id = $livro_id;

            $resultado = $edicaoDAO->cadastrar($edicao);
        }

        // Redirecionando com status de sucesso ou erro
        $status = $resultado ? 'success' : 'error';
        $message = $resultado ? 'Operação realizada com sucesso!' : 'Erro ao realizar operação!';
        header("Location: ../views/edicao.php?status=$status&message=$message");
        exit;

    } elseif (isset($_POST['_method']) && $_POST['_method'] === 'DELETE' && isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Exclusão de edição
        $id = $_POST['id'];

        $resultado = $edicaoDAO->excluir($id);
        $status = $resultado ? 'success' : 'error';
        $message = $resultado ? 'Edição excluída com sucesso!' : 'Erro ao excluir a edição!';

        header("Location: ../views/edicao.php?status=$status&message=$message");
        exit;
    } else {
        // Caso falhe na validação dos campos
        header("Location: ../views/edicao.php?status=error&message=Campos inválidos ou faltando.");
        exit;
    }
}

// Caso não seja uma requisição POST, redireciona
header("Location: ../views/edicao.php");
exit;
?>
