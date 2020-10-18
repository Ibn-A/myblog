
<footer class="site-footer">
    <div class="container">
    <div class="row mb-5">
        <div class="col-md-4">
            <h3 class="footer-heading mb-4">A propos de moi</h3>
            <p>Riche d'une expérience dans l'enseignement et dans le secteur associatif, je souhaite désormais étendre mon expérience et mon savoir-faire dans le développement web au service d'une société innovante et qui ambitionne de bouleverser son secteur. </p>
        </div>
        <div class="col-md-3 ml-auto">
        <!-- <h3 class="footer-heading mb-4">Navigation</h3> -->
            <ul class="list-unstyled float-left mr-5">
                <li><a href="#">PHP</a></li>
                <li><a href="#">Symfony</a></li>
                <li><a href="#">Laravel</a></li>
                <li><a href="#">Python/Flask</a></li>
            </ul>
            <ul class="list-unstyled float-left">
                <li><a href="#">javascript</a></li>
                <li><a href="#">bootstrap</a></li>
                <li><a href="#">react.js</a></li>
                <li><a href="#">SEO</a></li>
            </ul>
        </div>
        <div class="col-md-4">
        

        <div>
            <h3 class="footer-heading mb-4">Gardons le contact</h3>
            <p>
            <a href="#"><span class="icon-facebook pt-2 pr-2 pb-2 pl-0"></span></a>
            <a href="#"><span class="icon-twitter p-2"></span></a>
            <a href="#"><span class="icon-instagram p-2"></span></a>
            <a href="#"><span class="icon-rss p-2"></span></a>
            <a href="#"><span class="icon-envelope p-2"></span></a>
            </p>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <p>
            Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This blog has been made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="#" target="_blank" >Ibn Ali</a>
            </p>
        </div>
    </div>
    </div>
</footer>


<div class="bg-light py-4 footer mt-auto">
    <container class="container">
        <?php if (defined('DEBUG_TIME')):?>
        Page généré en <?=  (microtime(true) - DEBUG_TIME) ?> ms.
        <?php endif ?>
    </container>
</div>