<ul class="uk-navbar-nav <?= $breakpoint ? 'uk-visible-@'.$breakpoint : '' ?>">

    <?php foreach($nodes as $node) : ?>

        <li class="<?= $node->get('active') ? ' uk-active' : '' ?>">

            <a href="<?= $node->getUrl() ?>"><?= $node->title ?></a>

            <?php if ($node->hasChildren()) : ?>
                <div class="uk-navbar-dropdown">
                    <?= $view->render('nav.php', ['root' => $node, 'modifier' =>'uk-navbar-dropdown-nav','parent_depth' => 1]) ?>
                </div>
            <?php endif ?>

        </li>

    <?php endforeach ?>

</ul>