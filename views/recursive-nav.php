<?php foreach ($root->getChildren() as $node) : ?>

    <li <?= $node->get('active') ? 'class="uk-active"' : '' ?>>

        <a href="<?= $node->getUrl() ?>"><?= $node->title ?></a>

        <?php if ($node->hasChildren()) : ?>
            <ul <?= $level == 0 ? 'class="uk-nav-sub"' : '' ?>>
                <?= $view->tm()->recursiveNav($node, $level++) ?>
            </ul>
        <?php endif ?>

    </li>

<?php endforeach ?>