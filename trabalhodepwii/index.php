<?php
$serve = "127.0.0.1";
$user = "root";
$password = "68146956m"; 
$dbname = "projeto";
$connect = mysqli_connect($serve, $user, $password, $dbname);

if (!$connect) {
    die("Erro na conexão: " . mysqli_connect_error());
}

if (isset($_POST["adicionar"])) {
    $titulo = mysqli_real_escape_string($connect, $_POST["m-titulo"]);
    $noticias_reportagens = mysqli_real_escape_string($connect, $_POST["m-reportagem"]);
    $imagem_noticia = mysqli_real_escape_string($connect, $_POST["m-img"]);
    $titulo_imagem = mysqli_real_escape_string($connect, $_POST["m-img-nome"]);

    if (empty($titulo) || empty($noticias_reportagens) || empty($imagem_noticia) || empty($titulo_imagem)) {
        echo "<p>Preencha todos os campos!</p>";
    } else {
        $adicionar = "INSERT INTO noticias (titulo, noticias_reportagens, imagem_noticia, titulo_imagem) 
                      VALUES ('$titulo', '$noticias_reportagens', '$imagem_noticia', '$titulo_imagem')";
        if (mysqli_query($connect, $adicionar)) {
            echo "<p>Notícia adicionada com sucesso!</p>";
        } else {
            echo "<p>Erro ao adicionar notícia: " . mysqli_error($connect) . "</p>";
        }
    }
}

if (isset($_POST["editar"])) {
    $id = intval($_POST["id_noticias"]);
    $titulo = mysqli_real_escape_string($connect, $_POST["edit-titulo"]);
    $noticias_reportagens = mysqli_real_escape_string($connect, $_POST["edit-reportagem"]);
    $imagem_noticia = mysqli_real_escape_string($connect, $_POST["edit-img"]);
    $titulo_imagem = mysqli_real_escape_string($connect, $_POST["edit-img-nome"]);

    if (empty($titulo) || empty($noticias_reportagens) || empty($imagem_noticia) || empty($titulo_imagem)|| $id <= 0) {
        echo "<p>Preencha todos os campos!</p>";
    } else {
        $editar = $connect->prepare("UPDATE noticias SET titulo=?, noticias_reportagens=?, imagem_noticia=?, titulo_imagem=? WHERE noticia_id=?");
        $editar->bind_param("ssssi", $titulo, $noticias_reportagens, $imagem_noticia, $titulo_imagem, $id);
        if ($editar->execute()) {
            echo "<p>Notícia atualizada com sucesso!</p>";
        } else {
            echo "<p>Erro ao atualizar notícia: " . $editar->error . "</p>";
        }
        $editar->close();
    }
}

if (isset($_POST["excluir"])) {
    $id = intval($_POST["id_noticias"]);
    if ($id > 0) {
        $excluir = $connect->prepare("DELETE FROM noticias WHERE noticia_id = ?");
        $excluir->bind_param("i", $id);
        
        if (mysqli_query($connect, $excluir)) {
            echo "<p>Notícia excluída com sucesso!</p>";
        } else {
            echo "<p>Erro ao excluir notícia: " . mysqli_error($connect) . "</p>";
        }
    } else {
        echo "<p>ID inválido!</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Notícias</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Notícias</a><br>
        <a href="quemsomos.html">Quem somos?</a><br>
        <a href="perfil.html">Perfil</a><br>
    </nav>


    <section id="noticiasid" class="noticiasclass">
        <?php
        $exibedados = "SELECT * FROM noticias";
        $dadosquery = mysqli_query($connect, $exibedados);
        if ($dadosquery && mysqli_num_rows($dadosquery) > 0) {
            while ($dados = mysqli_fetch_array($dadosquery)) {
                ?>
                <div class="noticiasclass" id="noticiasid">
                    <div class="ntclass" id="ntcid">
                        
                        <img src="<?php echo $dados["imagem_noticia"]; ?>" alt="<?php echo $dados["titulo_imagem"]; ?>" width="300" height="200">
                        <h3><?php echo $dados["titulo"]; ?></h3>
                    </div>
                    <div class="acoes">

                        <form method="POST">
                            <button class="lixeiraclass" type="submit" name="excluir">
                                <img src="imagens/lixeira-de-reciclagem.png" alt="Excluir" width="25" height="25">
                            </button>
                        </form>
                            <button  class="editarclass" onclick="openModalEditar()">
                                <img src="imagens/arquivo-e-pasta.png" alt="Editar" width="25" height="25">
                            </button>
                            <button class="lerclass" onclick="vernoticia()">
                                <img src="imagens/olho-aberto.png" alt="ler" width="25" height="25">
                            </button>
                        
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </section>
    <div class="modal" id="modaller">
        <div class="modal_info">
            <button class="close_modal" onclick="closeModaller()">X</button>
                <h3><?php echo $dados["titulo"]; ?></h3>
                <img src="<?php echo $dados["imagem_noticia"]; ?>" alt="<?php echo $dados["titulo_imagem"]; ?>" width="300" height="200">   
                <p><?php echo $dados["noticias_reportagens"]; ?></p>
        </div>
    </div>

    <div div class="adicionarclass" id="adicionarid">
        <button class="addbtnclass" id="btncanceladd"onclick="openaModalAdd()">+</button>
    </div>

    <div class="modal" id="modalAdicionar">
        <div class="modal_info">
            <button class="close_modal" onclick="closeModalAdd()">X</button>
            <form class="adicionar" id="adicionar" method="POST">
                <label for="m-titulo">Titulo</label>
                <input id="m-titulo" name="m-titulo" type="text" required />

                <label for="m-reportagem">Reportagem</label>
                <input id="m-reportagem" name="m-reportagem" type="text" required />

                <label for="m-img">Imagem (ex.: "imagens/imagem.png")</label>
                <input id="m-img" name="m-img" type="text" required />

                <label for="m-img-nome">Nome da imagem</label>
                <input id="m-img-nome" name="m-img-nome" type="text"  required />

                <button id="salvarCrud" class="salvar crud" name="adicionar" type="submit">Salvar</button>
            </form>        
        </div>
    </div>

    
    <div id="modalEditar" class="modal">
        <div class="modal_info">
            <button class="close_modal" onclick="closeModalEditar()">X</button>
            <form method="POST" class="informacaoedt" id="informacaoedt" >
                <label for="id_noticias">id</label>
                <input type="hidden" id="id_noticias" name="id_noticias">
                
                <label for="edit-titulo">Título</label>
                <input id="edit-titulo" name="edit-titulo" type="text" required>
                
                <label for="edit-reportagem">Reportagem</label>
                <input id="edit-reportagem" name="edit-reportagem" type="text" required>
                
                <label for="edit-img">Imagem</label>
                <input id="edit-img" name="edit-img" type="text" required>
                
                <label for="edit-img-nome">Nome da Imagem</label>
                <input id="edit-img-nome" name="edit-img-nome" type="text" required>
                
                <button type="submit" name="editar">Salvar Alterações</button>
            </form>
        </div>
    </div>
        <script src="script.js"></script>

    <!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
