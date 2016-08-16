<?php echo $view['ivory_google_place_autocomplete']->render($autocomplete, $attr) ?>
<?php if ($api): ?>
    <?php echo $view['ivory_google_api']->render([$autocomplete]) ?>
<?php endif; ?>
