<?php
use App\Connection;
use App\Model\Post;
use App\Model\Category;
use App\URL;
use App\Paginated;
use App\Table\CategoryTable;
use App\Table\PostTable;

$id = $params['id'];
$slug = $params['slug'];


$pdo = Connection::getPDO();
$category = (new CategoryTable($pdo))->find($id);

if ($category->getSlug() !== $slug) {
    $url = $router->url('category', ['category' => $category->getSlug(), 'id'=>$id]);
    http_response_code(301);
    header('Location:' . $url);
}
$title = "Catégorie {$category->getName()}";

[$posts, $paginated] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

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