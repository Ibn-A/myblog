<?php
use App\Connection;
use App\Model\Post;
use App\Model\Category;
use App\URL;

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

$currentPage = URL::getPositiveInt('page', 1);


//récupère le nombre total d'articles
$count = (int)$pdo
    ->query('SELECT COUNT(id_category) FROM post_category WHERE id_category =' . $category->getID())
    ->fetch(PDO::FETCH_NUM)[0];

$perPage = 12;
//récupère le nombre total de pages
$pages = ceil($count / $perPage);
if ($currentPage > $pages) {
    throw new Exception('Cette page n\'existe pas');
}
//récupère les 12 dernières articles triés par date
$offset = $perPage * ($currentPage - 1);
$query = $pdo->query("
    SELECT p.* 
    FROM post p
    JOIN post_category pc ON pc.id_post = p.id_post
    WHERE pc.id_category = {$category->getID()}
    ORDER BY created_at DESC 
    LIMIT $perPage OFFSET $offset
");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);

?>

<h1> <?=$title?></h1>
<div class="row">
    <?php foreach($posts as $post): ?>
    <div class="col-md-4">
        <?php require dirname(__DIR__) . '/post/card.php' ?>
    </div>
    <?php endforeach ?>
</div>
<div class="d-flex justify-content-between my-4">
        <?php if ($currentPage > 1):?>
            <?php 
            $l = $link;
            if ($currentPage > 2) $l = $link . '?page=' . ($currentPage -1);
            ?>
            <a href="<?= $l?>" class="btn btn-primary">&laquo; Page précédente</a>
        <?php endif?>
        <?php if ($currentPage < $pages):?>
            <a href="<?= $link?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto"> Page suivante &raquo;</a>
        <?php endif?>
</div>