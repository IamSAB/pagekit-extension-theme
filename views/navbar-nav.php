<ul class="uk-navbar-nav">

    <?php foreach($nodes as $node) : ?>

        <li class="<?= $node->get('active') ? ' uk-active' : '' ?>">

            <a href="<?= $node->getUrl() ?>"><?= $node->title ?></a>

            <?php if ($node->hasChildren()) : ?>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <?= $view->tm()->recursiveNav($node) ?>
                    </ul>
                </div>
            <?php endif ?>

        </li>

    <?php endforeach ?>

</ul>