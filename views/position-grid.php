<div class="uk-grid <?= $classes ?> <?= $custom ?> <?= $height != 'viewport' ? $height : '' ?>" uk-grid <?= $height == 'viewport' ? "uk-height-viewport='$ukHeightViewport'" : '' ?>>

    <?php foreach ($widgets as $widget) : ?>

        <div class="<?= $widget->theme['grid']['classes'] ?> <?= $widget->theme['grid']['custom'] ?>">

            <?= $view->tm()->card($view->tm()->heading($widget->title, $widget->theme['heading'], 'uk-card-title'), $widget->get('result'), $widget->theme['grid']['card']) ?>

        </div>

    <?php endforeach ?>

</div>