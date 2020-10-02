<?php
use App\Connection;
use App\Table\PostTable;


$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

if (!empty($_POST)) {
    $post->setTitle($_POST['name']);
    $postTable->update($post);
    $success = true;
}
?>

<?php if ($success = true):?>
    <div class="alert alert-success">
        L'article a bien été modifié
    </div>
<?php endif ?>

<h1> Editer l'article : <?= he($post->getTitle())?></h1>

<form action="" method="POST">
    <div class="form-group">
        <label for="name" >Titre</label>
        <input type="text" class="form-control" name="name" value="<?= he($post->getTitle())?>">
    </div>
    <button class="btn btn-primary">Modifier</button>
</form>