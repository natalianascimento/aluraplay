<?php

$dbPath = __DIR__ . '/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');

    $sql = 'SELECT * FROM videos WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $video = $statement->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estilos-form.css">
    <link rel="stylesheet" href="../css/flexbox.css">
    <title>AluraPlay</title>
    <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>

<body>

    <!-- Cabecalho -->
    <header>

        <nav class="cabecalho">
            <a class="logo" href="../index.php"></a>

            <div class="cabecalho__icones">
                <a href="./enviar-video.html" class="cabecalho__videos"></a>
                <a href="../pages/login.html" class="cabecalho__sair">Sair</a>
            </div>
        </nav>

    </header>

    <main class="container">

        <form class="container__formulario" action="<?php echo isset($_GET['id']) ? "/editar-video.php" : "/novo-video.php"; ?>" method="post">
            <h2 class="formulario__titulo">Envie um vídeo!</h2>
                
            <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link embed</label>
                    <?php if (isset($_GET['id'])): ?>
                        <input name="url" class="campo__escrita" value="<?= $video['url'] ?>" required id='url' />
                        <?php else: ?>
                    <input name="url" class="campo__escrita" required
                        placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g" id='url' />
                    <?php endif; ?>
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    <?php if (isset($_GET['id'])): ?>
                        <input name="titulo" class="campo__escrita" required value="<?= $video['title'] ?>" id='titulo' />
                        <input name="id" type=hidden value="<?= $video['id'] ?>" id='titulo' />
                        <?php else: ?>
                    <input name="titulo" class="campo__escrita" required placeholder="Neste campo, dê o nome do vídeo"
                        id='titulo' />
                    <?php endif; ?>
                </div>

                <input class="formulario__botao" type="submit" value="Enviar" />
        </form>

    </main>

</body>

</html>