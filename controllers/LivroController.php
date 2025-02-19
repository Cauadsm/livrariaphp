<?php
include_once '../dao/LivroDAO.php';
include_once '../dao/AutorDAO.php';

$livroDAO = new LivroDAO();
$autorDAO = new AutorDAO();

// Verificando se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verificando se os campos obrigatórios estão preenchidos
    if (isset($_POST['titulo'], $_POST['autor_id']) && !empty($_POST['titulo']) && is_numeric($_POST['autor_id'])) {
        $titulo = $_POST['titulo'];
        $autor_id = $_POST['autor_id'];

        // Se o ID do livro estiver presente, significa edição
        if (!empty($_POST['id'])) {
            $livro = new Livros();
            $livro->id = $_POST['id'];
            $livro->titulo = $titulo;
            $livro->autor_id = $autor_id;

            $resultado = $livroDAO->editar($livro);
        } else { // Caso contrário, é cadastro
            $livro = new Livros();
            $livro->titulo = $titulo;
            $livro->autor_id = $autor_id;

            $resultado = $livroDAO->cadastrar($livro);
        }

        // Redirecionando com status
        $status = $resultado ? 'success' : 'error';
        header("Location: ../views/livros.php?status=$status");
        exit;

    } elseif (isset($_POST['_method']) && $_POST['_method'] === 'DELETE' && isset($_POST['id']) && is_numeric($_POST['id'])) {
        // Exclusão de livro
        $id = $_POST['id'];

        $resultado = $livroDAO->excluir($id);
        $status = $resultado ? 'success' : 'error';

        header("Location: ../views/livros.php?status=$status");
        exit;
    } else {
        // Caso falhe na validação dos campos
        header("Location: ../views/livros.php?status=error&message=Campos inválidos");
        exit;
    }
}

// Caso não seja uma requisição POST, redireciona
header("Location: ../views/livros.php");
exit;
?>
