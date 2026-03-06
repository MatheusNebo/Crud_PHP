CREATE DATABASE IF NOT EXISTS aula_php;

USE aula_php;

CREATE TABLE IF NOT EXISTS usuarios (
    codigo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    administrador TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS produtos (
    codigo_produto INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    imagem LONGBLOB DEFAULT NULL,
    imagem_tipo VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (codigo_produto)
) ENGINE = InnoDB;
