<?php
use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Model\Post;
use App\Model\Category;
$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);

// redirection vers la vraie url
if ($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id'=>$id]);
    http_response_code(301);
    header('Location:' . $url);
}

?>
 <div class="card-body">
    <h5 ><?= he($post->getTitle()) ?></h5>
    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y')?></p>
    <?php foreach($post->getCategories() as $k => $category):
        if($k > 0) {
            echo ', ';
        }
        $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
    ?>
        <a href="<?= $category_url?>"><?= $category->getName()?></a>
    <?php endforeach?>
    <p><?= $post->getContent() ?></p>

</div>
