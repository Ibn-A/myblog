<?php
use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use Valitron\Validator;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();//récupére les catégorie sous forme de liste
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);
$success = false;
$errors = [];
// conditions de validation du formulaire
if (!empty($_POST)) {
    Validator::lang('fr');
    //logique de la validation de données
    $v = new PostValidator($_POST, $postTable, $post->getID(), $categories);
    ObjectHelper::hydrate($post, $_POST, ['title','content', 'slug', 'created_at']);
  
    if ($v->validate()) {
        $pdo->beginTransaction();
        $postTable->updatePost($post);
        $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
        $pdo->commit();
        $categoryTable->hydratePosts([$post]);
        $success = true;
    }else {
        $errors = $v->errors();  
    } 
}
$form = new Form($post, $errors);
?>

<?php if ($success):?>
    <div class="alert alert-success">
        L'article #<?=$post->getID()?> a bien été modifié.
    </div>
<?php endif ?>
<?php if (isset($_GET['created'])):?>
    <div class="alert alert-success">
        L'article a bien été crée.
    </div>
<?php endif ?>

<?php if (!empty($errors)):?>
    <div class="alert alert-danger">
        L'article n'a pu être modifié, merci de corriger vos erreurs.
    </div>
<?php endif ?>

<h1> Editer l'article : <?= he($post->getTitle())?></h1>

<?php require('_form.php') ?>