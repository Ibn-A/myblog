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
$title = "Catégorie : {$category->getName()}";

[$posts, $paginated] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);

?>



<div class="site-section">
<h1> <?= he($title) ?></h1>
        <div class="container">
            <div class="row mb-5">
            <div class="col-12">
                <h2>Les Articles</h2>
            </div>
            </div>
            <div class="row">
                <?php foreach($posts as $post): ?>

                    <?php require dirname(__DIR__) . '/post/card.php' ?> 
            
                <?php endforeach ?>
            </div>
        </div>
    </div>

<div class="container d-flex justify-content-between my-4">
    <?=$paginated->previousLink($link) ?>
    <?=$paginated->nextLink($link) ?>
        
</div>
