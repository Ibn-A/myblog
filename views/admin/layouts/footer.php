<footer class="bg-light py-4 footer mt-auto">
    <container class="container">
        <?php if (defined('DEBUG_TIME')):?>
        Page généré en <?=  (microtime(true) - DEBUG_TIME) ?> ms.
        <?php endif ?>
    </container>
</footer>