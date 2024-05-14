CREATE DATABASE sisep_bd;

USE sisep_bd;

CREATE TABLE dados_pessoais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    data_nascimento DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    curso_desejado VARCHAR(100) NOT NULL,
    laudo_medico TINYINT(1) NOT NULL
);

CREATE TABLE endereco (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    rua VARCHAR(255) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(255),
    comprovante_residencia ENUM('Sim', 'Não') NOT NULL
);

CREATE TABLE notas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_candidato INT NOT NULL,
    nota_sexto FLOAT NOT NULL,
    nota_setimo FLOAT NOT NULL,
    nota_oitavo FLOAT NOT NULL,
    nota_nonobim1 FLOAT NOT NULL,
    nota_nonobim2 FLOAT NOT NULL,
    nota_nonobim3 FLOAT NOT NULL,
    nota_nonobim4 FLOAT NOT NULL,
    FOREIGN KEY (id_candidato) REFERENCES dados_pessoais(id)
);

CREATE TABLE notas_portugues(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_candidato INT NOT NULL,
    nota_portugues_sexto FLOAT NOT NULL,
    nota_portugues_setimo FLOAT NOT NULL,
    nota_portugues_oitavo FLOAT NOT NULL,
    nota_portugues_nonobim1 FLOAT NOT NULL,
    nota_portugues_nonobim2 FLOAT NOT NULL,
    nota_portugues_nonobim3 FLOAT NOT NULL,
    nota_portugues_nonobim4 FLOAT,
    FOREIGN KEY (id_candidato) REFERENCES dados_pessoais(id)
);

CREATE TABLE notas_matematica(
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_candidato INT NOT NULL,
    nota_matematica_sexto FLOAT NOT NULL,
    nota_matematica_setimo FLOAT NOT NULL,
    nota_matematica_oitavo FLOAT NOT NULL,
    nota_matematica_nonobim1 FLOAT NOT NULL,
    nota_matematica_nonobim2 FLOAT NOT NULL,
    nota_matematica_nonobim3 FLOAT NOT NULL,
    nota_matematica_nonobim4 FLOAT,
    FOREIGN KEY (id_candidato) REFERENCES dados_pessoais(id)
);

CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(25) NOT NULL
);

INSERT INTO admin (nome, email, senha) VALUES ('Mateus', 'mateus@gmail.com', 'jujuba123')
