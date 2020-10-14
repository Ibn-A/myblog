<div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar" role="banner">
    <div class="container-fluid">
        <div class="row align-items-center">

            <div class="col-4 site-logo">
                <a href="<?= $router->url('home')?>" class="text-black h2 mb-0 navbar-brand">Mon site</a>
            </div>

            <div class="col-8 text-right">
                <nav class="site-navigation" role="navigation">
                <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                    <li><a href="<?= $router->url('home')?>">Home</a></li>
                    <li><a href="#">Php</a></li>
                    <li><a href="#">Symfony</a></li>
                    <li><a href="#">Laravel</a></li>
                    <li><a href="#">SEO</a></li>
                    <li><a href="#">Web</a></li>
                </ul>
                </nav>
                <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a>
            </div>

        </div>
    </div>
</header>