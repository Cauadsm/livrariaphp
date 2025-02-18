<?php
include_once '../dao/EdicaoDao.php';
include_once '../dao/LivroDAO.php';

$edicaoDAO = new EdicaoDao();
$livroDAO = new LivroDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['descricao']) && isset($_POST['livro_id'])) {
        // Cadastro de edição especial
        $descricao = $_POST['descricao'];
        $livro_id = $_POST['livro_id'];

        $edicao = new Edicao();
        $edicao->descricao = $descricao;
        $edicao->livro_id = $livro_id;

        if ($edicaoDAO->cadastrar($edicao)) {
            header("Location: ../views/edicao.php?status=success");
        } else {
            header("Location: ../views/edicao.php?status=error");
        }
        exit;
    } elseif (isset($_POST['_method']) && $_POST['_method'] === 'DELETE' && isset($_POST['id'])) {
        // Exclusão de edição especial
        $id = $_POST['id'];

        if ($edicaoDAO->excluir($id)) {
            header("Location: ../views/edicao.php?status=success");
        } else {
            header("Location: ../views/edicao.php?status=error");
        }
        exit;
    }
}

// Redireciona caso o método não seja POST
header("Location: ../views/edicoes.php");
exit;
?>
