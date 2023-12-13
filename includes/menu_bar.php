<div id="topo"> <!-- início div topo - marca + menu de navegação -->
        <button id="toggleBtn">Menu</button>
        	<ul>
                <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);

                    // Check if it's not the home page
                    if ($currentPage !== 'index.php') {
                        echo '<li><a class="um" href="index.php">Home</a></li>';
                    }
                ?>
                <li><a class="dois" href="perfil.php">Perfil</a></li>
                <li><a class="tres" href="clientes.php">Clientes</a></li>
                <li><a class="quatro" href="galeria.php">Galerias</a></li>
                <li><a class="cinco" href="eventos.php">Eventos</a></li>
                <li><a class="sete" href="imprensa.php">Imprensa</a></li>
                <li><a class="oito" href="contato.php">Contato</a></li>
            </ul>
            
            <h1 class="header-title" >NBastian Fotografia | Comunicação</h1>

            <script>
            // JavaScript to handle menu toggle
            document.addEventListener("DOMContentLoaded", function () {
                var toggleBtn = document.getElementById("toggleBtn");
                var menu = document.querySelector("#topo ul");

                toggleBtn.addEventListener("click", function () {
                menu.classList.toggle("show");
                });
            });
            </script>
        </div> <!-- fim div topo -->
<style>
.header-title {
    font-size: 24px;
    margin: 10px 0;
    text-align: center;
    transition: color 0.3s ease;
}

.header-title:hover {
    color: #a7c0d1;
}


</style>