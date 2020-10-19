<?php
use App\Connection;
use App\model\User;
use App\HTML\Form;
use App\Table\UserTable;
use App\Table\Exception\NotFoundException;


$user = new User();
$errors = [];
if (!empty($_POST)) {
    $user->setUsername($_POST['username']);
    $errors['password'] =  'Identifiant ou mot de passe incorrect';

    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $table = new UserTable(Connection::getPDO());
        try {
            $u = $table->findByUsername($_POST['username']);
            if(password_verify($_POST['password'] , $u->getPassword()) === true ) {
                session_start();
                $_SESSION['auth'] = $u->getId();
                header('Location:' .$router->url('admin_posts'));
                exit();
            }
        } catch (NotFoundException $e) {
        }  
    }
}
$form = new Form($user, $errors);

?>
<h1> Se connecter </h1>

<?php if(isset($_GET['forbidden'])) : ?>
<div class="alert alert-danger">
    Vous ne pouvez pas accéder a cette page.
</div>
<?php endif ?>
<div class="container">
<form action="<?= $router->url('login')?>" method="POST" class="mb-4">
    <?= $form->input('username', 'Nom d\'utilisateur');?>
    <?= $form->input('password', 'Mot de passe');?>
    <button type="submit" class="btn btn-primary"> Se connecter</button>

</form>
</div>