<?php
include_once '../config/database.php';
include_once '../models/Livros.php';

class LivroDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Listar todos os livros com seus respectivos autores
    public function listar()
    {
        $query = "SELECT livro.id, livro.titulo, livro.autor_id, autor.nome AS autor_nome 
              FROM livro 
              JOIN autor ON livro.autor_id = autor.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $livros = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { //criando ojeto livros
            $livro = new Livros();
            $livro->id = $row['id'];
            $livro->titulo = $row['titulo'];
            $livro->autor_id = $row['autor_id'];
            $livro->autor_nome = $row['autor_nome'];  // Adicionando autor_nome ao objeto Livros
            $livros[] = $livro;
        }

        return $livros;
    }


    // Cadastrar um novo livro, associando o autor
    public function cadastrar(Livros $livro)
    {
        $query = "INSERT INTO livro (titulo, autor_id) VALUES (:titulo, :autor_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":titulo", $livro->titulo);
        $stmt->bindParam(":autor_id", $livro->autor_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Excluir um livro
    public function excluir($id)
    {
        try {
            $query = "DELETE FROM livro WHERE id = :id";
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

    public function editar(Livros $livro)
    {
        $query = "UPDATE livro SET titulo = :titulo, autor_id = :autor_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $livro->id, PDO::PARAM_INT);
        $stmt->bindParam(":titulo", $livro->titulo);
        $stmt->bindParam(":autor_id", $livro->autor_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>