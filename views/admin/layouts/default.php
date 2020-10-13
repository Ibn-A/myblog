<!DOCTYPE html>
<html lang="fr" class="h-100">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($title) ? he($title) : "Mon Site" ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body class="d-flex flex-column h-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a href="<?= $router->url('home')?>" class="navbar-brand"> Mon site</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= $router->url('admin_posts')?>" class="nav-link"  style="color:white"> Articles</a>    
                    </li>
                    <li class="nav-item">
                        <a href="<?= $router->url('admin_categories')?>" class="nav-link"  style="color:white"> Categories</a> 
                    </li>
                </ul>
            </div>
        </nav> 

        <div class="container mt-4">
            <?= $content ?>

        </div>

        <footer class="bg-light py-4 footer mt-auto">
            <container class="container">
                <?php if (defined('DEBUG_TIME')):?>
                Page généré en <?=  (microtime(true) - DEBUG_TIME) ?> ms.
                <?php endif ?>
            </container>
        </footer>   
    </body>
</html>