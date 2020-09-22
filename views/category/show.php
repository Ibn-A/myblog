<?php
use App\Connection;
use App\Model\Post;
use App\Model\Category;
use App\URL;
use App\Paginated;

$id = $params['id'];
$slug = $params['slug'];


$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM category WHERE id_category = :id');
$query->execute(['id' => $id ]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category|false */
$category = $query->fetch();

if ($category === false) {
    throw new Exception('Aucune catégorie ne correspond a cet ID');
}

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['category' => $category->getSlug(), 'id'=>$id]);
    http_response_code(301);
    header('Location:' . $url);
}
$title = "Catégorie {$category->getName()}";

$paginated = new Paginated(
    "SELECT p.* 
    FROM post p
    JOIN post_category pc ON pc.id_post = p.id_post
    WHERE pc.id_category = {$category->getID()}
    ORDER BY created_at DESC",
    "SELECT COUNT(id_category) FROM post_category WHERE id_category = {$category->getID()} "
);
/** @var Posts[] */
$posts = $paginated->getItems(Post::class);
$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);

?>

<h1> <?= he($title) ?></h1>
<div class="row">
    <?php foreach($posts as $post): ?>
    <div class="col-md-4">
        <?php require dirname(__DIR__) . '/post/card.php' ?>
    </div>
    <?php endforeach ?>
</div>
<div class="d-flex justify-content-between my-4">
    <?=$paginated->previousLink($link) ?>
    <?=$paginated->nextLink($link) ?>
        
</div>