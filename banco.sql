-- Criação do Banco de Dados
CREATE DATABASE IF NOT EXISTS nexus_data;
USE nexus_data;

-- Criação da Tabela de Contatos (Leads)
CREATE TABLE IF NOT EXISTS contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    servico VARCHAR(50) NOT NULL,
    mensagem TEXT,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);