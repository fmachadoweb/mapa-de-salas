<?php

/*
SISTEMA DE MAPA DE SALAS DE AULA
DESENVOLVIDO POR FERNANDO MACHADO
https://github.com/fmachadoweb
*/

// Defina o diretório onde os arquivos .txt estão armazenados
$diretorio = 'log/';

// Verifica se o diretório existe
if (is_dir($diretorio)) {
    // Obtém todos os arquivos do diretório e ordena em ordem alfabética
    $arquivos = scandir($diretorio);

    // Inverte a ordem dos arquivos para exibir o mais novo primeiro
    $arquivos = array_reverse($arquivos);

    echo '<h2>Logs de acesso ao sistema:</h2>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>Log</th><th>Descrição</th></tr>';

    // Itera sobre todos os arquivos do diretório
    foreach ($arquivos as $arquivo) {
        // Verifica se o arquivo tem extensão .txt
        if (pathinfo($arquivo, PATHINFO_EXTENSION) == 'txt') {
            echo '<tr>';
            
            // Exibe o nome do arquivo
            echo '<td>' . $arquivo . '</td>';
            
            // Lê o conteúdo do arquivo
            $conteudo = file_get_contents($diretorio . $arquivo);
            
            // Exibe o conteúdo
            echo '<td>' . nl2br($conteudo) . '</td>';
            
            echo '</tr>';
        }
    }

    echo '</table>';
} else {
    echo "O diretório não existe.";
}
?>
