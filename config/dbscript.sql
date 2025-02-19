CREATE DATABASE livraria;
USE livraria;

CREATE TABLE autor (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE livro (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    autor_id INT,
    FOREIGN KEY (autor_id) REFERENCES autor(id) ON DELETE CASCADE
);

CREATE TABLE edicao_especial (
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao TEXT,
    livro_id INT,
    FOREIGN KEY (livro_id) REFERENCES livro(id) ON DELETE CASCADE
);
