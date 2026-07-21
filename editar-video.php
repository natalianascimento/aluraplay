<?php
$dbPath = __DIR__ . '/banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");

$id = filter_input(INPUT_POST, 'id');
$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$titulo = filter_input(INPUT_POST, 'titulo');

if($id === false) {
    header('Location: /index.php?sucesso=0');
    exit();
} 

$sql = "UPDATE videos SET url = :url, title = :titulo WHERE ID = :id;";
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':titulo', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

if($statement->execute() === false) {
    header('Location: /index.php?sucesso=0');
} else {
    header('Location: /index.php?sucesso=1');
}