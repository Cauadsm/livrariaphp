<?php
include_once '../config/database.php';
include_once '../models/Edicao.php';

class EdicaoDao {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function listar() {
        $query = "SELECT * FROM edicao_especial";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome) {
        $query = "INSERT INTO edicao_especial (descricao) VALUES (:descricao)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":descricao", $descricao);
        return $stmt->execute();
    }

    public function excluir($id) {
        $query = "DELETE FROM edicao_especial WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>