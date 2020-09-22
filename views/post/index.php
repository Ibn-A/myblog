<?php 
use App\Helpers\Text;
use App\Model\Post;
use App\Connection;
use App\URL;
use App\Paginated;

$title = "Mon Blog"; 
$pdo = Connection::getPDO();

$paginated = new Paginated(
    "SELECT * FROM post ORDER BY created_at DESC",
    "SELECT COUNT(id_post) FROM post"
);
$posts = $paginated->getItems(Post::class);
$link = $router->url('home');
?>
<h1> Mon Blog</h1>

<div class="row">
    <?php foreach($posts as $post): ?>
    <div class="col-md-4">
        <?php require 'card.php' ?>
    </div>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
        <?= $paginated->previousLink($link);?>
        <?= $paginated->nextLink($link);?>
</div>