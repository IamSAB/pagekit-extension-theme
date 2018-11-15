<div class="uk-card <?= $classes ?>">

    <?php if ($header): ?>
        <div class="uk-card-header">
            <?= $header ?>
        </div>
    <?php endif ?>

    <div class="uk-card-body">
        <?= $heading ?>
        <p>
            <?= $content ?>
        </p>
    </div>

    <?php if ($footer): ?>
        <div class="uk-card-footer">
            <?= $footer ?>
        </div>
    <?php endif ?>

</div>