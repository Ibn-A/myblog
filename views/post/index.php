<?php 
use App\Helpers\Text;
use App\Model\Post;
use App\Model\Category;
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
//recupérations des catégories des articles
$postsByID = [];
foreach($posts as $post) {
    $postsByID[$post->getID()] = $post;
}

$categories = $pdo->query('SELECT c.*, pc.id_post 
             FROM post_category pc 
             JOIN category c ON c.id_category = pc.id_category 
             WHERE pc.id_post IN(' . implode(',', array_keys($postsByID)) . ')'
    )->fetchAll(PDO::FETCH_CLASS, Category::class);
//On parcourt les catégories
foreach($categories as $category) {
    $postsByID[$category->getPostID()]->addCategory($category);
}
    // On trouve l'article $posts correspondant à la ligne
        //On ajoute la catégorie à l'article

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