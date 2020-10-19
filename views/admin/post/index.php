<?php
use App\Connection;
use App\Table\PostTable;
use App\Auth;

Auth::check();

$router->layout = "admin/layouts/defaults";
$title = "Gestion des articles";
$pdo = Connection::getPDO();
[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

$link = $router->url('admin_posts');
?>

<h1> Gestion des articles</h1>

<?php if (isset($_GET['delete'])): ?>
<div class="alert alert-success">
    L'enregistrement a bien été supprimé.
</div>
<?php endif ?>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>
                <a href="<?= $router->url('admin_post_new')?>" class="btn btn-primary"> Créer un article</a>
            </th>
        </tr> 
    </thead>
    <tbody>
        <?php foreach ($posts as $post) :?>
        <tr>
            <td>#<?= $post->getID()?></td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getID()])?>">
                    <?= he($post->getTitle())?>
                </a>
            </td>
            <td>
                <a href="<?= $router->url('admin_post', ['id' => $post->getID()])?>" class="btn btn-primary">
                    Editer
                </a>
                <form action ="<?= $router->url('admin_post_delete', ['id' => $post->getID()])?>" method="POST"
                    onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?')" style="display:inline">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>


<div class="d-flex justify-content-between my-4">
        <?= $pagination->previousLink($link);?>
        <?= $pagination->nextLink($link);?>
</div>