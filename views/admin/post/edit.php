<?php
use App\Connection;
use App\Table\PostTable;
use Valitron\Validator;
use App\HTML\Form;
use App\Validators\PostValidator;

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];
// conditions de validation du formulaire
if (!empty($_POST)) {
    Validator::lang('fr');
    //logique de la validation de données
    $v = new PostValidator($_POST, $postTable, $post->getID());
    $post
        ->setTitle($_POST['title'])
        ->setSlug($_POST['slug'])
        ->setContent($_POST['content'])
        ->setCreatedAt($_POST['created_at']);
        
    if ($v->validate()) {
        $postTable->update($post);
        $success = true;
    }else {
        $errors = $v->errors();  
    } 
}
$form =new Form($post, $errors);
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
    <?= $form->input('title','Titre'); ?>
    <?= $form->input('slug', 'URL');?>
    <?= $form->textarea('content', 'Contenu'); ?>
    <?= $form->input('created_at', 'Date de publication'); ?>
    <button class="btn btn-primary">Modifier</button>
</form>