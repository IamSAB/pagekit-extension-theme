<div class="<?= $classes ?> <?= $custom ?>">

    <?php if ($type == 'panel'): ?>
        <div class="uk-panel">
            <?= $content ?>
        </div>
    <?php elseif ($type == 'tile'): ?>
        <?= $view->tm()->tile('Widget') ?>
    <?php elseif ($type == 'card'): ?>
        <?= $view->tm()->card('Widget') ?>
    <?php endif ?>

</div>