<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $view->render('head') ?>
        <?php if ($params['css']) : ?>
            <?php $view->style('uikit-theme-custom', $view->url($params['css'])) ?>
        <?php else : ?>
            <?php $view->style('uikit-theme', 'theme:css/theme.css') ?>
        <?php endif ?>
        <?php $view->script('uikit-v3', 'theme:app/bundle/uikit.js') ?>
    </head>

    <body id="top">

        <div class="uk-offcanvas-content">

            <?php if ($view->position()->exists('TopA')): ?>
                <?= $view->tm()->section('TopA', $view->tm()->position('TopA')) ?>
            <?php endif; ?>

            <?= $view->tm()->nested(['section' => ['Main'], 'custom' => ['main.php']]) ?>

        </div>

        <?= $view->render('footer') ?>

    </body>

</html>
