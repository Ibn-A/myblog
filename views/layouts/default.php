<!DOCTYPE html>
<html lang="fr" class="h-100">
    <head>
        <title><?= isset($title) ? he($title) : "Mon Blog sur le développement web" ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

        <link rel="stylesheet" href="/fonts/icomoon/style.css">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/magnific-popup.css">
        <link rel="stylesheet" href="/css/jquery-ui.css">
        <link rel="stylesheet" href="/css/owl.carousel.min.css">
        <link rel="stylesheet" href="/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
        <link rel="stylesheet" href="/fonts/flaticon/font/flaticon.css">
        <link rel="stylesheet" href="/css/aos.css">
        

        <link rel="stylesheet" href="/css/style.css">
        
    </head>
    <body>
    <div class="site-wrap">

        <?php include("header.php");?>


        <div class="site-section bg-light">
            <div class="container">
                <?= $content ?>
            </div>
        </div>


        <?php include("footer.php");?>   

    </div>

    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/jquery.stellar.min.js"></script>
    <script src="/js/jquery.countdown.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <script src="/js/aos.js"></script>

    <script src="/js/main.js"></script>      
        
    </body>
</html>