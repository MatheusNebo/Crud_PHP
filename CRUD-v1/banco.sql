CREATE DATABASE IF NOT EXISTS aula_php;

USE aula_php;

CREATE TABLE IF NOT EXISTS usuarios (
    codigo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    administrador TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB; --(ACID), consintencia, isolamento e integridade

CREATE TABLE IF NOT EXISTS produtos (
    codigo_produto INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    imagem LONGBLOB DEFAULT NULL,
    imagem_tipo VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (codigo_produto)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS clientes (
    codigo_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,  -- Nome ou Razão Social
    tipo_documento ENUM('CPF', 'CNPJ') DEFAULT 'CPF',
    documento VARCHAR(20) UNIQUE NOT NULL,  -- Guarda CPF ou CNPJ
    telefone VARCHAR(20),
    email VARCHAR(100),
    endereco TEXT,
    cidade VARCHAR(50),
    estado CHAR(2),
    data_cadastro DATE DEFAULT (CURRENT_DATE)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS vendas (
    codigo_venda INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATETIME DEFAULT CURRENT_TIMESTAMP,
    codigo_cliente INT,
    codigo_usuario INT,
    valor_total DECIMAL(10,2),
    forma_pagamento ENUM('dinheiro','cartao','pix','boleto') DEFAULT 'pix',
    status ENUM('concluida','cancelada','pendente') DEFAULT 'concluida',

    FOREIGN KEY (codigo_cliente) REFERENCES clientes(codigo_cliente),
    FOREIGN KEY (codigo_usuario) REFERENCES usuarios(codigo_usuario)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS venda_itens (
    codigo_item INT AUTO_INCREMENT PRIMARY KEY,
    codigo_venda INT,
    codigo_produto INT,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2),
    subtotal DECIMAL(10,2),

    FOREIGN KEY (codigo_venda) REFERENCES vendas(codigo_venda),
    FOREIGN KEY (codigo_produto) REFERENCES produtos(codigo_produto)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS metas (
    codigo_meta INT AUTO_INCREMENT PRIMARY KEY,
    codigo_usuario INT,
    mes DATE NOT NULL,
    meta_vendas DECIMAL(10,2),
    atingido DECIMAL(10,2) DEFAULT 0,
    
    FOREIGN KEY (codigo_usuario) REFERENCES usuarios(codigo_usuario)
) ENGINE = InnoDB;