<?php
$cssData['fonts']     = 'fonts.css';
$cssData['fontsMin']  = 'fonts.min.css';
?>
<?php foreach ($cssData as $key => $value) : ?>
    <?php foreach ($css as $keyA => $valueA) : ?>
        <?php if ($key == $valueA) : ?>
            <link rel="stylesheet" href="/assets/layouts/css/<?= $value; ?>" type="text/css" />
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<link rel="stylesheet" href="/assets/layouts/css/content.css" type="text/css" />

<style type="text/css">

</style>