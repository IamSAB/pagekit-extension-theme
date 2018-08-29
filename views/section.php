<div class="uk-section <?= $classes ?> <?= $custom ?>" <?= $src ? sprintf('data-src="%s" uk-img', $view->url($src)): '' ?>>
    <div class="uk-container <?= $container ?>">
        <?= $content ?>
    </div>
</div>
