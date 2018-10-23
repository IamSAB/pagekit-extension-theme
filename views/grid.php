<div class="uk-grid <?= $classes ?> <?= $custom ?> <?= $height != 'viewport' ? $height : '' ?>" uk-grid <?= $height == 'viewport' ? "uk-height-viewport='$ukHeightViewport'" : '' ?>>
    <?php foreach ($widgets as $widget) : ?>
        <?= $view->tm()->widget($widget) ?>
    <?php endforeach ?>
</div>