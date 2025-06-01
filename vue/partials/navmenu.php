<nav id="default-nav-menu">
    <?php
    $keys = ['home', 'commands', 'tools', 'about', 'contact', 'help-us'];
    foreach ($keys as $path) {
        echo '<a href="../../vue/pages/' . $path . '.php">' . strtoupper($_SESSION['translations']->get('global.navbar.' . $path)) . '</a>';
    }
    ?>
</nav>