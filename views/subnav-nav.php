<ul class="uk-subnav <?= isset($modifier) ? $modifier : ''?>">

    <?php foreach ($nodes as $node) : ?>

        <li class="<?= $node->get('active') ? ' uk-active' : '' ?>">

            <a href="<?= $node->getUrl() ?>"><?= $node->title ?></a>

            <?php if ($node->hasChildren()) : ?>
                <div uk-dropdown="<?= $click ? 'mode: click;' : '' ?>">
                    <ul class="uk-nav uk-dropdown-nav">
                        <?= $view->tm()->recursiveNav($node) ?>
                    </ul>
                </div>
            <?php endif ?>

        </li>

    <?php endforeach ?>

</ul>