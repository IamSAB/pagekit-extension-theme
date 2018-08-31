<?php
    if ($heading != 'hide') {
        $h = "<$htag class=".($type == 'card' ? ($heading ? $heading : 'uk-card-title') : $heading).">".
                ($hlink ? "<a class='uk-link-reset' href='#$title'>$title</a>" : "<span>$title</span>").
            "</$htag>";
    } else {
        $h = '';
    }
?>

<div class="<?= $gridItemClasses ?> <?= $custom ?>">
    <div class="uk-<?= $type ?> <?= $containerClasses ?>">
        <?php if ($type == 'card'): ?>
            <div class="uk-card-body">
                <?= $h ?>
                <p> <?= $content ?> </p>
            </div>
        <?php else: ?>
            <?= $h . $content ?>
        <?php endif ?>
    </div>
</div>