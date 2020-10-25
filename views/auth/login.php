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

<?php if(isset($_GET['forbidden'])) : ?>
<div class="alert alert-danger">
    Vous ne pouvez pas accéder a cette page.
</div>
<?php endif ?>
<div class="container my-4">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h2 class="card-title text-center"> Se Connecter </h2>
                    <form action="<?= $router->url('login')?>" method="POST" class="form-signin">
                        <?= $form->input('username', 'Nom d\'utilisateur');?>
                        <?= $form->input('password', 'Mot de passe');?>
                        <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase"> Se connecter</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>