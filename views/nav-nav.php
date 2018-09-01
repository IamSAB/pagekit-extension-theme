<ul class="uk-nav uk-nav-default <?= $modifier ?>">

    <?php foreach ($nodes as $node) : ?>

        <?= $view->tm()->recursiveNav($node) ?>

    <?php endforeach ?>

</ul>