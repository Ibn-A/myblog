<?php
use App\Connection;
use App\Table\CategoryTable;
use Valitron\Validator;
use App\HTML\Form;
use App\Validators\CategoryValidator;
use App\ObjectHelper;
use App\Auth;

Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);
$success = false;
$errors = [];
$fields = ['name', 'slug'];

// conditions de validation du formulaire
if (!empty($_POST)) {
    Validator::lang('fr');
    //logique de la validation de données
    $v = new CategoryValidator($_POST, $table, $item->getID());
    ObjectHelper::hydrate($item, $_POST, $fields );
    if ($v->validate()) {
        $table->update($item);
        $success = true;
    }else {
        $errors = $v->errors();  
    } 
}
$form = new Form($item, $errors);
?>

<?php if ($success):?>
    <div class="alert alert-success">
        La Catégorie #<?=$item->getID()?> a bien été modifié.
    </div>
<?php endif ?>
<?php if (isset($_GET['created'])):?>
    <div class="alert alert-success">
        La Catégorie a bien été crée.
    </div>
<?php endif ?>

<?php if (!empty($errors)):?>
    <div class="alert alert-danger">
        La Catégorie n'a pu être modifié, merci de corriger vos erreurs.
    </div>
<?php endif ?>

<h1> Editer La Catégorie : <?= he($item->getName())?></h1>

<?php require('_form.php') ?>