<form action="" method="POST">
    <?= $form->input('title','Titre'); ?>
    <?= $form->input('slug', 'URL');?>
    <?= $form->textarea('content', 'Contenu'); ?>
    <?= $form->input('created_at', 'Date de publication'); ?>
    <button class="btn btn-primary">
    <?php if ($post->getID() !== null) : ?>
        Modifier
    <?php else : ?>
        Créer
    <?php endif ?>
    </button>
</form>