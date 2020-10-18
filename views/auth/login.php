<?php
use App\model\User;
use App\HTML\Form;

$user = new User();
$errors = [];
if (!empty($_POST)) {
    $user->setUsername($_POST['username']);
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $errors['password'] = 'Identifiant ou mot de passe incorrect';
    }
}
$form = new Form($user, $errors);

?>
<h1> Se connecter </h1>

<form action="" method="POST">
    <?= $form->input('username', 'Nom d\'utilisateur');?>
    <?= $form->input('password', 'Mot de passe');?>
    <button type="submit" class="btn btn-primary"> Se connecter</button>

</form>
