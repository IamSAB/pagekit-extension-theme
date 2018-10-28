<div class="uk-card <?= $classes ?>">

    <?php if ($header): ?>
    <div class="uk-card-header">
        <h3 class="uk-card-title"></h3>
    </div>
    <?php endif ?>

    <div class="uk-card-body">
        <?= $view->render('theme-core/heading.php', compact('h_style','h_default_style','h_tag','link')) ?>
        <?= $content ?>
    </div>

    <?php if ($footer): ?>
    <div class="uk-card-footer">
        <?= $footer ?>
    </div>
    <?php endif ?>

</div>