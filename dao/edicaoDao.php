<?php
include_once '../config/database.php';
include_once '../models/Edicao.php';

class EdicaoDao
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function listar()
    {
        $query = "SELECT edicao_especial.id, edicao_especial.descricao, edicao_especial.livro_id, 
                     livro.titulo AS livro_nome 
              FROM edicao_especial
              JOIN livro ON edicao_especial.livro_id = livro.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function cadastrar(Edicao $edicao)
    {
        $query = "INSERT INTO edicao_especial (descricao,livro_id) VALUES (:descricao, :livro_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":descricao", $edicao->descricao);
        $stmt->bindParam(":livro_id", $edicao->livro_id);
        return $stmt->execute();
    }

    public function excluir($id)
    {
        try {
            $query = "DELETE FROM edicao_especial WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $executed = $stmt->execute();

            if ($executed) {
                return true; // Retorna true se a exclusão for bem-sucedida
            } else {
                return false; // Retorna false se a exclusão falhar
            }

        } catch (PDOException $ex) {
            // Log do erro  
            error_log("Erro ao excluir livro: " . $ex->getMessage());
            return false; // Retorna false em caso de erro
        }
    }
}
?>