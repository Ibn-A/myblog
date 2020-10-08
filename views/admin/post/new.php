<?php
use App\Connection;
use App\Table\PostTable;
use Valitron\Validator;
use App\HTML\Form;
use App\Validators\PostValidator;
use App\ObjectHelper;
use App\model\Post;


$errors = [];
$post = new Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));

if (!empty($_POST)) {
    $pdo = Connection::getPDO();
    $postTable = new PostTable($pdo);
    Validator::lang('fr');
    //logique de la validation de données
    $v = new PostValidator($_POST, $postTable, $post->getID());
    ObjectHelper::hydrate($post, $_POST, ['title','content', 'slug', 'created_at']);
  
    if ($v->validate()) {
        $postTable->create($post);
        header('Location: '. $router->url('admin_post', ['id'=> $post->getID()]) . '?created=1');
        exit();
    }else {
        $errors = $v->errors();  
    }  
}
$form = new Form($post, $errors);

?>

<?php if (!empty($errors)):?>
    <div class="alert alert-danger">
        L'article n'a pas pu être enregistré, merci de corriger vos erreurs.
    </div>
<?php endif ?>

<h1> Créer un article  </h1>

<?php require('_form.php') ?>