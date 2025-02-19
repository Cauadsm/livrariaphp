<?php
include_once '../config/database.php';
include_once '../models/Autor.php';

class AutorDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function listar()
    {
        $query = "SELECT * FROM autor";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome)
    {
        $query = "INSERT INTO autor (nome) VALUES (:nome)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $nome);
        return $stmt->execute();
    }

    public function excluir($id)
    {
        try {
            $query = "DELETE FROM autor WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Garantindo que o tipo seja INT
            $executed = $stmt->execute();

            if ($executed) {
                return true; // Retorna true se a exclusão for bem-sucedida
            } else {
                return false; // Retorna false se a exclusão falhar
            }

        } catch (PDOException $ex) {
            // Log do erro  
            error_log("Erro ao excluir autor: " . $ex->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    public function editar($id, $nome) {
        $query = "UPDATE autor SET nome = :nome WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

}
?>