<?php
$jsData['sweetalertMin']    = 'plugin/sweetalert/sweetalert.min.js';
$jsData['select2']          = 'plugin/select2/select2.min.js';
$jsData['tagsinput']        = 'plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js';
?>

<?php foreach ($jsData as $key => $value) : ?>
    <?php foreach ($js as $keyA => $valueA) : ?>
        <?php if ($key == $valueA) : ?>
            <script type="text/javascript" src="/assets/layouts/js/<?= $value; ?>" charset="UTF-8"></script>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>

<script type="text/javascript" src="/assets/layouts/js/custome.js"></script>

<?php
$logo       = 'blue'; // dark, blue, purple, light-blue, green, orange, red, white,  dark2, blue2, purple2, light-blue2, green2, orange2, red2
$navbar     = 'blue2'; // dark, blue, purple, light-blue, green, orange, red, white, dark2, blue2, purple2, light-blue2, green2, orange2, red2
$sidebar    = 'white'; // white, dark, dark2
$background = 'blue'; // bg2, bg1, bg3, dark, blue
?>

<script type="text/javascript">
    function checkThemeColor() {
        // ## Logo ## 
        if ($(this).attr('data-color') == 'default') {
            $('.logo-header').removeAttr('data-background-color');
        } else {
            $('.logo-header').attr('data-background-color', '<?= $logo; ?>');
        }
        customCheckColor();

        // ## Navbar Header ## 
        if ($(this).attr('data-color') == 'default') {
            $('.main-header .navbar-header').removeAttr('data-background-color');
        } else {
            $('.main-header .navbar-header').attr('data-background-color', '<?= $navbar; ?>');
        }

        // ## Sidebar ## 
        if ($(this).attr('data-color') == 'default') {
            $('.sidebar').removeAttr('data-background-color');
        } else {
            $('.sidebar').attr('data-background-color', '<?= $sidebar; ?>');
        }

        // ## Background ##
        $('body').removeAttr('data-background-color');
        $('body').attr('data-background-color', '<?= $background; ?>');
    }

    function customCheckColor() {
        var logoHeader = $('.logo-header').attr('data-background-color');
        if (logoHeader !== "white") {
            $('.logo-header .navbar-brand').attr('src', '/assets/layouts/img/logo.svg');
        } else {
            $('.logo-header .navbar-brand').attr('src', '/assets/layouts/img/logo2.svg');
        }
    }

    <?php
    foreach ($NewJavaScript as $value) :
    ?>
        <?php
        if ($value == 'select2Menu') :
        ?>
            $('#autocomplete').select2({
                theme: "bootstrap",
                placeholder: "Please select a parent menu",
                allowClear: true,
                minimumInputLength: 1,
                ajax: {
                    url: '<?php echo base_url('menu/getMenuByTitle'); ?>',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        <?php
        endif;
        ?>
        <?php
        if ($value == 'select2') :
        ?>
            $('#select2').select2({
                theme: "bootstrap",
                allowClear: true,
                minimumInputLength: 1,
            });
        <?php
        endif;
        ?>
        <?php
        if ($value == 'avatarPreview') :
        ?>

            function previewImg() {
                const avatar = document.querySelector('#avatar');
                const avatarLabel = document.querySelector('.custom-file-label');
                const imgPreview = document.querySelector('.img-preview');

                avatarLabel.textContent = avatar.files[0].name;

                const fileAvatar = new FileReader();
                fileAvatar.readAsDataURL(avatar.files[0]);

                fileAvatar.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            }
        <?php
        endif;
        ?>
        <?php
        if ($value == 'changeMenuPermission') :
        ?>
            $('.switch').on('click', function() {
                const menu_id = $(this).data('menu');
                const role_id = $(this).data('role');

                $.ajax({
                    url: "<?= base_url('/menu/changeMenuPermission'); ?>",
                    type: 'post',
                    data: {
                        menu_id: menu_id,
                        role_id: role_id
                    },
                    success: function() {
                        document.location.href = "/menu/accesscontrol/";
                    }
                });
            });
        <?php
        endif;
        ?>
        <?php
        if ($value == 'changePermission') :
        ?>
            $('.switch').on('click', function() {
                const permission_id = $(this).data('permission');
                const role_id = $(this).data('role');

                $.ajax({
                    url: "<?= base_url('/permission/changePermission'); ?>",
                    type: 'post',
                    data: {
                        permission_id: permission_id,
                        role_id: role_id
                    },
                    success: function() {
                        document.location.href = "/permission/accesscontrol/";
                    }
                });
            });
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