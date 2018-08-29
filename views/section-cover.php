<div class="uk-cover-container">
    <?php if ($cover == 'img'): ?>
        <img <?= $src ? sprintf('data-src="%s" uk-img', $view->url($src)): '' ?> uk-cover>
    <?php elseif ($cover == 'video'): ?>
        <video src="<?= $src ?>" uk-cover></video>
    <?php  elseif ($cover == 'iframe'): ?>
        <iframe src="<?= $src ?>" uk-cover></iframe>
    <?php endif; ?>
    <div class="uk-position-relative uk-section <?= $classes ?> <?= $custom ?>">
        <div class="uk-container <?= $container ?>">
            <?= $content ?>
        </div>
    </div>
</div>