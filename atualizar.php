<?php

/*
SISTEMA DE MAPA DE SALAS DE AULA
DESENVOLVIDO POR FERNANDO MACHADO
https://github.com/fmachadoweb
*/

session_start();

// Função para verificar se o usuário está logado
function esta_logado() {
    return isset($_SESSION['logado']) && $_SESSION['logado'] === true;
}

// Credenciais de login (agora com três usuários)
$usuarios = [
    "usuario1" => "senha1",
    "usuario2" => "senha2",
    "usuario3" => "senha3"
];

// Inicializa a variável de controle de login
$logado = false;

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Verifica se o usuário e senha estão corretos
    if (array_key_exists($usuario, $usuarios) && $usuarios[$usuario] === $senha) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario; // Salva o nome do usuário na sessão
        $logado = true;

        // Salva o log do login
        salvar_log($usuario);
    } else {
        $erro_login = "Usuário ou senha incorretos.";
    }
}

// Função para salvar o log do login
function salvar_log($usuario) {
    $data_hora = date('d-m-Y-H-i-s');
    $log = "Usuário: " . $usuario . " fez login em: " . date('d/m/Y H:i:s') . "\n";
    $nome_arquivo = "log/{$data_hora}.txt";

    // Verifica se a pasta log/ existe, se não, cria a pasta
    if (!file_exists('log')) {
        mkdir('log', 0777, true);
    }

    // Salva o log no arquivo .txt
    file_put_contents($nome_arquivo, $log);
}

// Se o usuário estiver logado, pode ver o conteúdo
if ($logado || (isset($_SESSION['logado']) && $_SESSION['logado'] === true)) {
    $_SESSION['logado'] = true;
}
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: #696969;
        }
        .content-wrapper {
            padding: 0;
        }
        .nav-buttons {
            padding: 10px;
            background-color: #f8f9fa;
        }
        .hidden {
            display: none;
        }
        #include-container {
            width: 100vw;
        }
        #include-container table {
            width: 100%;
            margin: 0;
        }
        #login-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        #login-form {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        #login-form h2 {
            margin-bottom: 20px;
        }

        #login-form input, #login-form button {
            width: 100%;
            margin-bottom: 10px;
        }

        #login-form button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            font-size: 12px;
        }
        .coluna-fixa {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        /* modal (fundo) */
        .modal {
            display: none; /* Escondido por padrão */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0); /* Cor de fundo */
            background-color: rgba(0,0,0,0.4); /* Cor de fundo com opacidade */
        }
        /* conteúdo do modal */
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            height: 80%;
            position: relative;
        }
        /* botão de fechar */
        .close-btn {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close-btn:hover,
        .close-btn:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        /* Contêiner dos botões */
        .button-container {
            margin-bottom: 10px;
        }
        /* Estilo dos botões no modal */
        .modal-button {
            background-color: #007bff; /* Fundo azul */
            color: white; /* Texto branco */
            border: none;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            cursor: pointer;
            width: 100%;
        }
        .modal-button:hover {
            background-color: #0056b3; /* Cor de fundo quando o mouse passa por cima */
        }
		#app {
			background-color: #fff;
			width: 30%;
			border: 3px darkblue solid;
			border-radius: 15px;
			display: block; /* Necessário para o margin funcionar */
			margin-top: 80px;
			margin-left: auto; /* aqui */
			margin-right: auto; /* e aqui */
		}
		@media screen and (max-width: 380px) {
		#app {
			width: 80%;
			margin-top: 30px;
			}
		}
		
		@media screen and (max-width: 500px) {
		#app {
			width: 80%;
			margin-top: 30px;
			}
		}
    </style>
</head>
<body>

    <?php if (!$logado): ?>
    <div id="login-overlay">
        <div id="login-form">
		<p><img src="images/logo.png" /></p><br />
            <h2 class="mb-3">Acesso Restrito</h2>
            <?php if (isset($erro_login)): ?>
                <div class="alert alert-danger"><?php echo $erro_login; ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuário:</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
				
            </form>
			<a href="index.php" ><button  class="btn btn-primary">Voltar</button></a>
        </div>
    </div>
    <?php else: ?>
    <!-- Botão para abrir o modal -->
	<div id="app" align="center"  >
	<br />
	<br />
	<p><img src="images/logo.png" /></p><br /><br />
	<h3>Bem vindo(a)!</h3>
	<h2><strong>MAPA DE SALAS</strong></h2>
	<br /><br />
    <button id="openModal" class="btn btn-primary">Clique aqui para atualizar</button>
	<br /><br /><br /><br />
	<a href="atualizar.php"><button  class="btn btn-primary">Deslogar</button></a>
	
	
	<br /><br /><br />
	<a style="text-decoration: none" href="https://www.hardtek.com.br" target="_blank"><code style="color: darkblue;"><b>Criado por: Fernando Machado</b></code></a><br /><br />
	</div>

    <!-- O Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <div class="button-container">
                <button class="modal-button" onclick="loadIframe('atualizar_manha.php')">Atualizar Turno Manhã</button>
                <button class="modal-button" onclick="loadIframe('atualizar_tarde.php')">Atualizar Turno Tarde</button>
                <button class="modal-button" onclick="loadIframe('atualizar_noite.php')">Atualizar Turno Noite</button>
            </div>
            <iframe id="modalIframe" width="100%" height="80%" frameborder="0"></iframe>
        </div>
    </div>



    <script>
        // Obter o modal
        var modal = document.getElementById("modal");

        // Obter o botão que abre o modal
        var btn = document.getElementById("openModal");

        // Obter o elemento <span> que fecha o modal
        var span = document.getElementById("closeModal");

        // Função para carregar o iframe
        function loadIframe(src) {
            document.getElementById("modalIframe").src = src;
        }

        // Quando o usuário clicar no botão, abre o modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Quando o usuário clicar no <span> (x), fecha o modal
        span.onclick = function() {
            modal.style.display = "none";
            document.getElementById("modalIframe").src = ""; // Limpar o iframe quando fechar
        }

        // Quando o usuário clicar em qualquer lugar fora do modal, fecha-o
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                document.getElementById("modalIframe").src = ""; // Limpar o iframe quando fechar
            }
        }
    </script>
    <?php endif; ?>
</body>
</html>
