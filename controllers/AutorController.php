<?php
include_once '../dao/autorDAO.php';

$autorDAO = new AutorDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome'])) {
        // Chama o método de cadastro no DAO
        $autorDAO->cadastrar($_POST['nome']);

        // Redireciona para a página anterior após o cadastro
        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../views/autores.php'; // Caso não tenha referência, redireciona para a página de lista

        // Verifica se o parâmetro 'status' já está na URL
        if (strpos($redirectUrl, 'status=') === false) {
            $redirectUrl .= '?status=success';
        } else {
            $redirectUrl .= '&status=success';
        }
        // Faz o redirecionamento
        header("Location: $redirectUrl");
        exit;
    } else {
        echo "Nome do autor não informado!";
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($autorDAO->listar()); //Testando json_enconde, transforma o resultado em json para ajudar no front.F
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
    // Verifica se o ID do autor foi enviado
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        // Chama o método de exclusão no DAO
        $autorDAO->excluir($id);

        // Redireciona para a página anterior sem repetir o parâmetro 'status'
        $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '../views/autores.php'; // Caso não tenha referência, redireciona para a página de lista
        // Remove o parâmetro 'status' da URL caso já exista
        $parsedUrl = parse_url($redirectUrl);
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        unset($queryParams['status']);
        // Reconstrua a URL sem o parâmetro 'status' repetido
        $newUrl = $parsedUrl['path'] . '?' . http_build_query($queryParams);

        // Adiciona o status na URL de redirecionamento
        header("Location: $newUrl&status=success");
        exit;
    } else {
        echo "ID do autor não encontrado!";
    }
}




//Utilizando controller não podemos utilizar pq method delete é diferente de method 

//POr isso temos que ler manualmente direto do corpo do site usando php://input 


?>