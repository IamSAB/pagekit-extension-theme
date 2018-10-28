<div class="uk-cover-container uk-height-large">

    <?php if ($type == 'img'): ?>
        <img <?= $src ? sprintf('data-src="%s" uk-img', $view->url($src)): '' ?> uk-cover>
    <?php elseif ($type == 'video'): ?>
        <video src="<?= $src ?>" uk-cover></video>
    <?php  elseif ($type == 'iframe'): ?>
        <iframe src="<?= $src ?>" uk-cover></iframe>
    <?php endif; ?>

    <?php foreach ($widgets as $widget) : ?>

        <div class="<?= $widget->theme['hero']['classes'] ?> <?= $widget->theme['hero']['custom'] ?>">

            <?= $view->tm()->widget($widget) ?>

        </div>

    <?php endforeach ?>

</div>