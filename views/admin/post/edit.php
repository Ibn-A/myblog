<?php
use App\Connection;
use App\Table\PostTable;


$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];
// conditions de validation du formulaire
if (!empty($_POST)) {
    if (empty($_POST['title'])) {
        $errors['title'][] = 'Le champs titre ne peut pas être vide';
    }
    if (mb_strlen($_POST['title'])  <= 3) {
        $errors['title'][] = 'Le champs titre doit contenir plus de 3 caractères';
    }
    $post->setTitle($_POST['title']);
    if (empty($errors)) {
        $postTable->update($post);
        $success = true;
    }
    
}
?>

<?php if ($success):?>
    <div class="alert alert-success">
        L'article #<?=$post->getID()?> a bien été modifié.
    </div>
<?php endif ?>
<?php if (!empty($errors)):?>
    <div class="alert alert-danger">
        L'article n'a pu être modifié, merci de corriger vos erreurs.
    </div>
<?php endif ?>

<h1> Editer l'article : <?= he($post->getTitle())?></h1>

<form action="" method="POST">
    <div class="form-group">
        <label for="name" >Titre</label>
        <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="title" value="<?= he($post->getTitle())?>">
        <?php if (isset($errors['title'])):?>
        <div class="invalid-feedback">
            <?= implode('<br>', $errors['title'])?>
        </div>
        <?php endif ?>
    </div>
    <button class="btn btn-primary">Modifier</button>
</form>