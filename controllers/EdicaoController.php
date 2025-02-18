<?php
include_once '../dao/edicaoDAO.php';

$autorDAO = new EdicaoDAO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['descricao'])) {
        $edicaoDAO->cadastrar(descricao: $_POST['descricao']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($edicaoDAO->listar()); //Testando json_enconde, transforma o resultado em json para ajudar no front.F
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $edicaoDAO->excluir($_DELETE['id']);
    
//Utilizando controller não podemos utilizar pq method delete é diferente de method 

//POr isso temos que ler manualmente direto do corpo do site usando php://input 

}
?>
