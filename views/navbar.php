<div>
    <nav class="uk-navbar-container <?= $transparent ? 'uk-position-absolute uk-navbar-transparent' : '' ?>">
        <div class="uk-container <?= $expand ? 'uk-container-expand' : '' ?>">
            <div class="uk-navbar" uk-navbar>
                <?= $content ?>
            </div>
        </div>
    </nav>
</div>