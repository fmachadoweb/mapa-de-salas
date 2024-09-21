<?php

/*
SISTEMA DE MAPA DE SALAS DE AULA
DESENVOLVIDO POR FERNANDO MACHADO
https://github.com/fmachadoweb
*/

try {
    $db = new PDO('sqlite:banco_tarde.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar a tabela se não existir
    $db->exec("DROP TABLE IF EXISTS tabela"); // Remove a tabela antiga se existir
    $db->exec("CREATE TABLE IF NOT EXISTS tabela (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        coluna1 TEXT,
        coluna2 TEXT,
        coluna3 TEXT,
        coluna4 TEXT,
        coluna5 TEXT
    )");

    // Inserir dados de teste
    $db->exec("INSERT INTO tabela (coluna1, coluna2, coluna3, coluna4, coluna5) VALUES ('Dado 1-1', 'Dado 1-2', 'Dado 1-3', 'Dado 1-4', 'Dado 1-5')");
    $db->exec("INSERT INTO tabela (coluna1, coluna2, coluna3, coluna4, coluna5) VALUES ('Dado 2-1', 'Dado 2-2', 'Dado 2-3', 'Dado 2-4', 'Dado 2-5')");
    $db->exec("INSERT INTO tabela (coluna1, coluna2, coluna3, coluna4, coluna5) VALUES ('Dado 3-1', 'Dado 3-2', 'Dado 3-3', 'Dado 3-4', 'Dado 3-5')");
    $db->exec("INSERT INTO tabela (coluna1, coluna2, coluna3, coluna4, coluna5) VALUES ('Dado 4-1', 'Dado 4-2', 'Dado 4-3', 'Dado 4-4', 'Dado 4-5')");

    echo "Tabela criada e dados inseridos com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
