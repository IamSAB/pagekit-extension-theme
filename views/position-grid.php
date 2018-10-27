<div class="uk-grid <?= $classes ?> <?= $custom ?> <?= $height != 'viewport' ? $height : '' ?>" uk-grid <?= $height == 'viewport' ? "uk-height-viewport='$ukHeightViewport'" : '' ?>>

    <?php foreach ($widgets as $widget) : ?>

        <div class="<?= $widget->theme['grid']['classes'] ?> <?= $widget->theme['grid']['custom'] ?>">

            <?= $view->tm()->widget($widget) ?>

        </div>

    <?php endforeach ?>

</div>