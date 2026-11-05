CREATE DATABASE IF NOT EXISTS closet_virtual;
USE closet_virtual;

-- tabela de usuarios
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- tabela das pecas de roupa
-- cada peca pertence a um usuario (chave estrangeira usuario_id)
CREATE TABLE peca_roupa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    nome_peca VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    cor VARCHAR(30),
    estacao VARCHAR(30),
    ocasiao VARCHAR(50),
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

-- usuario de teste
-- email: teste@email.com
-- senha: 123456
INSERT INTO usuario (nome, email, senha) VALUES
('Usuaria Teste', 'teste@email.com', '$2y$10$CEobfSzQ2VY26UeY4WWrr.YjP32nPQq0FpEX3CIbjjl/vkcaGLlAK');
