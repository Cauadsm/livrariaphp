<?php
include_once '../dao/LivroDAO.php';
include_once '../dao/AutorDAO.php';

$livroDAO = new LivroDAO();
$autorDAO = new AutorDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['titulo']) && isset($_POST['autor_id'])) {
        // Cadastro de livro
        $titulo = $_POST['titulo'];
        $autor_id = $_POST['autor_id'];

        // Criar o objeto Livro
        $livro = new Livros();
        $livro->titulo = $titulo;
        $livro->autor_id = $autor_id;

        // Cadastrar o livro
        if ($livroDAO->cadastrar($livro)) {
            header("Location: ../views/livros.php?status=success");
        } else {
            header("Location: ../views/livros.php?status=error");
        }
        exit;
    } elseif (isset($_POST['_method']) && $_POST['_method'] === 'DELETE' && isset($_POST['id'])) { //tenho que fazer desse jeito pq nao tem como usar o method delete, pq nao sou utilizar js
        // Exclusão de livro
        $id = $_POST['id'];

        if ($livroDAO->excluir($id)) {
            header("Location: ../views/livros.php?status=success");
        } else {
            header("Location: ../views/livros.php?status=error");
        }
        exit;
    }
}

// Caso o método não seja POST, redireciona para a página de gerenciamento de livros
header("Location: ../views/livros.php");
exit;
?>