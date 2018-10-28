<<?= $h_tag ?> class="<?= $h_style ? $h_style : $h_default_style ?>">
    <?php if ($h_link): ?>
        <a class='uk-link-reset' href="#<?= $title ?>"><?= $title ?></a>
    <?php else: ?>
        <span><?= $title ?></span>
    <?php endif ?>
</<?= $h_tag ?>>