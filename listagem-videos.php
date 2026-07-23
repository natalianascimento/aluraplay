<?php
$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);

if (isset ($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 1) {
        $mensagem = "Processo executado com sucesso.";
    } else {
        $mensagem = "Processo não executado.";
    }
}

?>
<?php require_once 'inicio-html.php'; ?>

    <?php if (isset($mensagem)): ?>
        <p class="mensagem__status"> <?= $mensagem ?> </p>
    <?php endif; ?>
    
    <ul class="videos__container" alt="videos alura">
        <?php foreach ($videoList as $video): ?>
        <?php if (str_starts_with($video['url'], 'http')): ?>
        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?= $video['url']; ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?= $video['title']; ?></h3>
                <div class="acoes-video">
                    <a href="./editar-video?id=<?= $video['id']; ?>">Editar</a>
                    <a href="./remover-video?id=<?= $video['id']; ?>">Excluir</a>
                </div>
            </div>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>

<?php require_once 'fim-html.php'; ?>