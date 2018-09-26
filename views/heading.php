<<?= $tag ?> class="<?= $type ? $type : $style ?>">
    <?php if ($link): ?>
        <a class='uk-link-reset' href="#<?= $title ?>"><?= $title ?></a>
    <?php else: ?>
        <span><?= $title ?></span>
    <?php endif ?>
</<?= $tag ?>>