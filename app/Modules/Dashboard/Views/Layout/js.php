<?php
$jsData['sweetalertMin'] = 'plugin/sweetalert/sweetalert.min.js';
?>

<?php foreach ($jsData as $key => $value) : ?>
    <?php foreach ($js as $keyA => $valueA) : ?>
        <?php if ($key == $valueA) : ?>
            <script src="/assets/layouts/js/<?= $value; ?>"></script>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<script type="text/javascript">
    <?php
    foreach ($NewJavaScript as $value) :
    ?>
        <?php
        if ($value == 'foo') :
        ?>
            console.log('yourScriptHere');
        <?php
        endif;
        ?>
        <?php
        if ($value == 'bar') :
        ?>
            console.log('yourScriptHereToo');
        <?php
        endif;
        ?>
    <?php
    endforeach;
    ?>
</script>