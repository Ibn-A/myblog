<?php 
use App\Connection;
use App\Table\PostTable;

$title = "Mon Blog"; 
$pdo = Connection::getPDO();

$table = new PostTable($pdo);
[$posts, $pagination]= $table->findPaginated();

$link = $router->url('home');
?>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
            <div class="col-12">
                <h2>Recent Posts</h2>
            </div>
            </div>
            <div class="row">
                <?php foreach($posts as $post): ?>
                <div class="col-lg-4 mb-4">
                    <?php require 'card.php' ?>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between my-4">
            <?= $pagination->previousLink($link);?>
            <?= $pagination->nextLink($link);?>
    </div>