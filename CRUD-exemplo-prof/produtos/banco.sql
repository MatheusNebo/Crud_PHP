CREATE DATABASE IF NOT EXISTS aula_php;

USE aula_php;

CREATE TABLE IF NOT EXISTS produtos (
    codigo_produto INT NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    imagem LONGBLOB DEFAULT NULL,
    imagem_tipo VARCHAR(50) DEFAULT NULL,
    PRIMARY KEY (codigo_produto)
) ENGINE = InnoDB;

-- Se a tabela já existir, execute:
-- ALTER TABLE produtos ADD COLUMN imagem LONGBLOB DEFAULT NULL;
-- ALTER TABLE produtos ADD COLUMN imagem_tipo VARCHAR(50) DEFAULT NULL;
