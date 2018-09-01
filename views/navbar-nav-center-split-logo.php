<div class="uk-navbar-center">

    <div class="uk-navbar-center-left">
        <div>
            <?= $view->render('theme-core:views/navbar-nav.php', ['nodes' => $left]) ?>
        </div>
    </div>

    <div class="uk-navbar-item">
        <?= $view->tm()->logo() ?>
    </div>

    <div class="uk-navbar-center-right">
        <div>
            <?= $view->render('theme-core:views/navbar-nav.php', ['nodes' => $right]) ?>
        </div>
    </div>

</div>