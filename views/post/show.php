<?php
use App\Connection;
use App\Model\Post;
use App\Model\Category;
$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$query = $pdo->prepare('SELECT * FROM post WHERE id_post = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
/** @var Post|false */

$post = $query->fetch();
if ($post === false) {
    throw new Exception('Aucun article ne correspond a cet ID');
}
// redirection vers la vraie url
if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id'=>$id]);
    http_response_code(301);
    header('Location:' . $url);
}
$query = $pdo->prepare('
SELECT c.id_category, c.slug_category, c.name_category
FROM post_category pc 
JOIN category c ON pc.id_category = c.id_category
WHERE pc.id_post = :id');
$query->execute(['id' => $post->getId()]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
/** @var Category[] */
$categories = $query->fetchAll();


?>
 <div class="card-body">
    <h5 ><?= he($post->getTitle()) ?></h5>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y')?></p>
    <?php foreach($categories as $category):
    ?>
        <a href="<?= $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()])?>"><?= $category->getName()?></a>
    <?php endforeach?>
    <p><?= $post->getContent() ?></p>

</div>
