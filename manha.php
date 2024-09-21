<?php

/*
SISTEMA DE MAPA DE SALAS DE AULA
DESENVOLVIDO POR FERNANDO MACHADO
https://github.com/fmachadoweb
*/

try {
    $db = new PDO('sqlite:banco_manha.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Recupera os dados da tabela
    $stmt = $db->query("SELECT * FROM tabela");
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

// Dados fixos das salas
$salas = [
    ["101", "12 PCS - BI"],
    ["102", "15 PCS - BI"],
    ["103", "SALA 25 LUGARES (TV)"],
    ["104", "16 PCS - HARDWARE (TV)"],
    ["201", "25 PCS - Arduíno, Cisco, GitHub"],
    ["202", "22 PCS - HARDWARE"],
    ["203", "20 PCS - REDES e Design"],
    ["204", "20 PCS"],
    ["205", "16 PCS- REDES, Design"],
    ["301", "12 PCS - Ultrabooks"],
    ["302", "12 PCS- BI, Design"],
    ["303", "29 PCS"],
    ["306", "25 PCS"],
    ["307", "32 PCS"],
    ["308", "41 PCS - BI, Design"],
    ["401", "18 PCS- REDES"],
    ["402", "12 PCS"],
    ["403", "12 PCS - GitHub, Xampp, Virtual Box, Cisco, Python"],
    ["404", "12 PCS"],
    ["405", "16 PCS"],
    ["406", "21 LUGARES - Ultrabooks"],
    ["407", "37 PCS - Arduíno, Design"]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa das Salas de Aula - Manhã</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            font-size: 12px; /* Ajuste este valor para mudar o tamanho da fonte */
        }
        th {
            background-color: #f2f2f2;
            font-size: 12px; /* Tamanho da fonte para cabeçalhos, se desejar diferenciá-los */
        }
        .coluna-fixa {
            font-weight: bold;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <h4>MAPA DE SALAS (MANHÃ) - <strong>SENAC TECH</strong> - <b><?php echo date("d-m-Y"); ?></b> - <b id="demo"> </b></h4>
    <table>
        <thead>
            <tr>
                <th>Sala</th>
                <th>Descrição</th>
                <th>SEG</th>
                <th>TER</th>
                <th>QUA</th>
                <th>QUI</th>
                <th>SEX</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salas as $index => $sala):
                $dadosLinha = $resultados[$index] ?? [];
            ?>
                <tr>
                    <td class="coluna-fixa"><?php echo htmlspecialchars($sala[0]); ?></td>
                    <td class="coluna-fixa"><?php echo htmlspecialchars($sala[1]); ?></td>
                    <td><?php echo htmlspecialchars($dadosLinha['coluna1'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($dadosLinha['coluna2'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($dadosLinha['coluna3'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($dadosLinha['coluna4'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($dadosLinha['coluna5'] ?? ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>