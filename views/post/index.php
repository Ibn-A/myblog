<?php 
use App\Helpers\Text;
use App\Model\Post;

$title = "Mon Blog"; 
$pdo = new PDO('mysql:host=127.0.0.1;dbname=blog', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
//Emplêcher les numéro de pages non entier
$page = $_GET['page'] ?? 1;
if(!filter_var($page, FILTER_VALIDATE_INT)) {
    throw new Exception('Numéro de page invalide');
}
// numéro de la page courante
$currentPage = (int)$page;
if ($currentPage <= 0) {
    throw new Exception('Numéro de page invalide');
}
//récupère le nombre total d'articles
$count = (int)$pdo->query('SELECT COUNT(id_post) FROM post')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
//récupère le nombre total de pages
$pages = ceil($count / $perPage);
if ($currentPage > $pages) {
    throw new Exception('Cette page n\'existe pas');
}
//récupère les 12 dernières articles triés par date
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);

?>
<h1> Mon Blog</h1>

<div class="row">
    <?php foreach($posts as $post): ?>
    <div class="col-md-3">
        <?php require 'card.php' ?>
    </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
        <?php if ($currentPage > 1):?>
            <?php 
            $link = $router->url('home');
            if ($currentPage > 2) $link .= '?page=' . ($currentPage -1);
            ?>
            <a href="<?= $link ?>" class="btn btn-primary">&laquo; Page précédente</a>
        <?php endif?>
        <?php if ($currentPage < $pages):?>
            <a href="<?= $router->url('home')?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto"> Page suivante &raquo;</a>
        <?php endif?>
</div>