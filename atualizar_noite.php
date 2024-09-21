<?php

/*
SISTEMA DE MAPA DE SALAS DE AULA
DESENVOLVIDO POR FERNANDO MACHADO
https://github.com/fmachadoweb
*/

try {
    $db = new PDO('sqlite:banco_noite.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela caso ela não existir
    $db->exec("CREATE TABLE IF NOT EXISTS tabela (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                coluna1 TEXT,
                coluna2 TEXT,
                coluna3 TEXT,
                coluna4 TEXT,
                coluna5 TEXT
            )");

    // Recupera a tabela para o formulário
    $stmt = $db->query("SELECT * FROM tabela");
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['atualizar'])) {
            $db->beginTransaction();
            
            for ($i = 1; $i <= 22; $i++) {  // 22 é o número total de salas
                $coluna1 = $_POST["linha{$i}_coluna1"] ?? '';
                $coluna2 = $_POST["linha{$i}_coluna2"] ?? '';
                $coluna3 = $_POST["linha{$i}_coluna3"] ?? '';
                $coluna4 = $_POST["linha{$i}_coluna4"] ?? '';
                $coluna5 = $_POST["linha{$i}_coluna5"] ?? '';
                
                if (isset($resultados[$i-1])) {
                    // Atualiza os dados existentes
                    $stmt = $db->prepare("UPDATE tabela 
                                          SET coluna1 = ?, coluna2 = ?, coluna3 = ?, coluna4 = ?, coluna5 = ?
                                          WHERE id = ?");
                    $stmt->execute([$coluna1, $coluna2, $coluna3, $coluna4, $coluna5, $i]);
                } else {
                    // Insere novos dados
                    $stmt = $db->prepare("INSERT INTO tabela (coluna1, coluna2, coluna3, coluna4, coluna5)
                                          VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([$coluna1, $coluna2, $coluna3, $coluna4, $coluna5]);
                }
            }
            
            $db->commit();
            echo "Dados atualizados com sucesso!";
        } elseif (isset($_POST['limpar'])) {
            $db->exec("DELETE FROM tabela");
            echo "Tabela limpa com sucesso!";
        }
    }
} catch (PDOException $e) {
    if (isset($db)) {
        $db->rollBack();
    }
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
    <title>Atualizar Salas de Aula - Noite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: var(--bs-gray-100);
        }
        .content-wrapper {
            background-color: var(--bs-white);
            border: 1px solid var(--bs-gray-200);
            margin-top: 0px;
            margin-bottom: 0px;
        }
        .nav-buttons {
            margin-top: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Atualizar Salas de Aula - Noite</h1>
    <form method="post">
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
                    $linhaId = $index + 1;
                    $dadosLinha = $resultados[$index] ?? [];
                ?>
                    <tr>
                        <td class="coluna-fixa"><?php echo htmlspecialchars($sala[0]); ?></td>
                        <td class="coluna-fixa"><?php echo htmlspecialchars($sala[1]); ?></td>
                        <td><input type="text" name="linha<?php echo $linhaId; ?>_coluna1" value="<?php echo htmlspecialchars($dadosLinha['coluna1'] ?? ''); ?>"></td>
                        <td><input type="text" name="linha<?php echo $linhaId; ?>_coluna2" value="<?php echo htmlspecialchars($dadosLinha['coluna2'] ?? ''); ?>"></td>
                        <td><input type="text" name="linha<?php echo $linhaId; ?>_coluna3" value="<?php echo htmlspecialchars($dadosLinha['coluna3'] ?? ''); ?>"></td>
                        <td><input type="text" name="linha<?php echo $linhaId; ?>_coluna4" value="<?php echo htmlspecialchars($dadosLinha['coluna4'] ?? ''); ?>"></td>
                        <td><input type="text" name="linha<?php echo $linhaId; ?>_coluna5" value="<?php echo htmlspecialchars($dadosLinha['coluna5'] ?? ''); ?>"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit" name="atualizar">Atualizar Dados</button>
        <button type="submit" name="limpar">Limpar Tabela</button>
    </form>
</body>
</html>