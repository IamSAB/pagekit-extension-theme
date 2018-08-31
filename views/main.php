<div uk-grid>

    <aside class="uk-width-1-4">
        Sidebar
    </aside>

    <main id="tm-main" class="uk-width-expand" uk-height-viewport="expand: true">

        <div id="tm-content">
            <div class="uk-container uk-container-expand ">
                <?= $view->render('content') ?>
            </div>
        </div>

    </main>

</div>