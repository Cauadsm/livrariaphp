<?php
include_once '../dao/autorDAO.php';

$autorDAO = new AutorDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];

        // Verifica se está editando ou cadastrando
        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $autorDAO->editar($id, $nome);
        } else {
            $autorDAO->cadastrar($nome);
        }

        // Garante que, após editar, não fique travado no modo edição
        header("Location: ../views/autores.php?status=success");
        exit;

        // Redirecionamento após a ação
        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../views/autores.php';
        $parsedUrl = parse_url($redirectUrl);
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        unset($queryParams['status']);
        $queryParams['status'] = 'success';
        $redirectUrl = $parsedUrl['path'] . '?' . http_build_query($queryParams);

        header("Location: $redirectUrl");
        exit;
    } else {
        echo "Nome do autor não informado!";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($autorDAO->listar());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $autorDAO->excluir($id);

        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../views/autores.php';
        $parsedUrl = parse_url($redirectUrl);
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        unset($queryParams['status']);
        $newUrl = $parsedUrl['path'] . '?' . http_build_query($queryParams);

        header("Location: $newUrl&status=success");
        exit;
    } else {
        echo "ID do autor não encontrado!";
    }
}
?>