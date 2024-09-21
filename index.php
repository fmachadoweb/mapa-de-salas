<!--
SISTEMA DE MAPA DE SALAS DE AULA
DESENVOLVIDO POR FERNANDO MACHADO
https://github.com/fmachadoweb
-->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa das Salas de Aula - Manhã</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="content-wrapper">
                    <div id="include-container">
                        <div class="include" id="include-0"><?php include("manha.php"); ?></div>
                        <div class="include hidden" id="include-1"><?php include("tarde.php"); ?></div>
                        <div class="include hidden" id="include-2"><?php include("noite.php"); ?></div>
                    </div>
                    <div class="nav-buttons d-flex justify-content-between">
                        <button id="prev" class="btn btn-primary">Anterior</button>
                        <button id="toggle" class="btn btn-secondary">Autoplay (10s)</button>
                        <button id="next" class="btn btn-primary">Próximo</button>
						<a href="atualizar.php" ><button  class="btn btn-primary">Login</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        let currentIndex = 0;
        const includes = document.querySelectorAll('.include');
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const toggleButton = document.getElementById('toggle');
        let autoScrollInterval;

        function showInclude(index) {
            includes.forEach((include, i) => {
                include.classList.toggle('hidden', i !== index);
            });
        }

        function prevInclude() {
            currentIndex = (currentIndex - 1 + includes.length) % includes.length;
            showInclude(currentIndex);
        }

        function nextInclude() {
            currentIndex = (currentIndex + 1) % includes.length;
            showInclude(currentIndex);
        }

        function toggleAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
                toggleButton.textContent = 'Alternar Automaticamente';
            } else {
                autoScrollInterval = setInterval(nextInclude, 10000); // alterna a cada 10 segundos
                toggleButton.textContent = 'Parar Alternância';
            }
        }

        prevButton.addEventListener('click', prevInclude);
        nextButton.addEventListener('click', nextInclude);
        toggleButton.addEventListener('click', toggleAutoScroll);

        showInclude(currentIndex);
    </script>
</body>
</html>