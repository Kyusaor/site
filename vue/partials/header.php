<header>
    <img alt="logo sparky" id="logo" src="../../data/pictures/main/logo.png">
    <h1>Sparky Bot</h1>

    <div class="custom-select" id="custom-select">
    <span id="placeholder" class="placeholder">
      <span class="img-wrapper">
        <img src="../../data/pictures/flags/<?= $_SESSION['language'] ?>.png" alt="language"/>
      </span>
    </span>
        <ul class="dropdown" id="dropdown">
            <?php
            include_once '../../src/modeles/translations.php';

            $pathList = TranslationManager::getFlagList();

            foreach ($pathList as $lang => $path) {
                echo '<li class="dd-item">';
                echo '<span class="img-wrapper">';
                echo '<img src="' . $path . '" alt="' . $lang . '"/> ';
                echo strtoupper($lang);
                echo '</span></li>';
            }
            ?>
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Array.from(document.getElementsByClassName('dd-item')).forEach(elem => {
                elem.addEventListener('click', () => {
                    const lang = window.location.host.split('.')[0];
                    const target = elem.lastChild.lastChild.textContent.toLowerCase().trim();
                    if (lang !== target)
                        window.location.href = window.location.href.replace(lang, target);
                })
            })
        })
    </script>
</header>