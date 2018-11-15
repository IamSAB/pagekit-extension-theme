<<?= $tag ?> class="<?= $style ? $style : $default ?>">
    <?php if ($link): ?>
        <!-- TODO kebabcase link of title -->
        <a class='uk-link-reset' href="#<?= $title ?>"><?= $title ?></a>
    <?php else: ?>
        <span><?= $title ?></span>
    <?php endif ?>
</<?= $tag ?>>