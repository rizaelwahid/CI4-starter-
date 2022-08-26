<?php
$jsData['sweetalertMin']    = 'plugin/sweetalert/sweetalert.min.js';
$jsData['select2']          = 'plugin/select2/select2.min.js';
$jsData['tagsinput']        = 'plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js';
$jsData['summernote']       = 'plugin/summernote/summernote-bs4.min.js';
$jsData['moment']           = 'plugin/moment/moment.min.js';
$jsData['datepicker']       = 'plugin/datepicker/bootstrap-datetimepicker.min.js';
$jsData['chartCircle']      = 'plugin/chart-circle/circles.min.js';
$jsData['chart']            = 'plugin/chart.js/chart.min.js';
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
$logo       = (get_cookie('logo') != NULL) ? get_cookie('logo') : 'blue';
$navbar     = (get_cookie('navbar') != NULL) ? get_cookie('navbar') : 'blue2';
$sidebar    = (get_cookie('sidebar') != NULL) ? get_cookie('sidebar') : 'white';
$background = (get_cookie('background') != NULL) ? get_cookie('background') : 'white';
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
        if ($value == 'select2') :
        ?>
            $('#select2').select2({
                theme: "bootstrap",
                allowClear: true,
                minimumInputLength: 1,
            });
        <?php
        endif;
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
        if ($value == 'summernote') :
        ?>
            $('#summernote').summernote({
                placeholder: 'Please input about site',
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                tabsize: 2,
                height: 300
            });
        <?php
        endif;
        if ($value == 'datepicker') :
        ?>
            $('#datetime').datetimepicker({
                format: 'H:mm',
            });
            $('#datepicker').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#timepicker').datetimepicker({
                format: 'h:mm A',
            });
        <?php
        endif;
        if ($value == 'chartCircle') :
        ?>
            Circles.create({
                id: 'circles-1',
                radius: 45,
                value: <?= $onlineVisitor; ?>,
                maxValue: 100,
                width: 7,
                text: <?= $onlineVisitor; ?>,
                colors: ['#f1f1f1', '#1572e8'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
            Circles.create({
                id: 'circles-2',
                radius: 45,
                value: <?= $onlineRegVisitor; ?>,
                maxValue: 100,
                width: 7,
                text: <?= $onlineRegVisitor; ?>,
                colors: ['#f1f1f1', '#1572e8'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
            Circles.create({
                id: 'circles-3',
                radius: 45,
                value: <?= $onlineGuestVisitor; ?>,
                maxValue: 100,
                width: 7,
                text: <?= $onlineGuestVisitor; ?>,
                colors: ['#f1f1f1', '#1572e8'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
            Circles.create({
                id: 'circles-4',
                radius: 45,
                value: <?= $todayVisitor; ?>,
                maxValue: 100,
                width: 7,
                text: <?= $todayVisitor; ?>,
                colors: ['#f1f1f1', '#1572e8'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
            Circles.create({
                id: 'circles-5',
                radius: 45,
                value: <?= $yesterdayVisitor; ?>,
                maxValue: 100,
                width: 7,
                text: <?= $yesterdayVisitor; ?>,
                colors: ['#f1f1f1', '#1572e8'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
            Circles.create({
                id: 'circles-6',
                radius: 45,
                value: <?= $totalVisitor; ?>,
                maxValue: 1000,
                width: 7,
                text: <?= $totalVisitor; ?>,
                colors: ['#f1f1f1', '#1572e8'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })
        <?php
        endif;
        if ($value == 'chart') :
        ?>
            htmlLegendsChart = document.getElementById('htmlLegendsChart').getContext('2d');

            var gradientStroke = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
            gradientStroke.addColorStop(0, '#177dff');
            gradientStroke.addColorStop(1, '#80b6f4');

            var gradientFill = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
            gradientFill.addColorStop(0, "rgba(23, 125, 255, 0.7)");
            gradientFill.addColorStop(1, "rgba(128, 182, 244, 0.3)");

            var gradientStroke2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
            gradientStroke2.addColorStop(0, '#f3545d');
            gradientStroke2.addColorStop(1, '#ff8990');

            var gradientFill2 = htmlLegendsChart.createLinearGradient(500, 0, 100, 0);
            gradientFill2.addColorStop(0, "rgba(243, 84, 93, 0.7)");
            gradientFill2.addColorStop(1, "rgba(255, 137, 144, 0.3)");

            var myHtmlLegendsChart = new Chart(htmlLegendsChart, {
                type: 'line',
                data: {
                    labels: [
                        <?php foreach ($weeklyUserVisitor as $data) : ?> "<?= date('l', strtotime($data['date'])) ?>",
                        <?php endforeach; ?>
                    ],
                    datasets: [{
                        label: "Guest",
                        borderColor: gradientStroke2,
                        pointBackgroundColor: gradientStroke2,
                        pointRadius: 0,
                        backgroundColor: gradientFill2,
                        legendColor: '#f3545d',
                        fill: true,
                        borderWidth: 1,
                        data: [
                            <?php foreach ($weeklyGuestVisitor as $data) : ?> "<?= $data['totalVisitor'] ?>",
                            <?php endforeach; ?>
                        ]
                    }, {
                        label: "User",
                        borderColor: gradientStroke,
                        pointBackgroundColor: gradientStroke,
                        pointRadius: 0,
                        backgroundColor: gradientFill,
                        legendColor: '#177dff',
                        fill: true,
                        borderWidth: 1,
                        data: [
                            <?php foreach ($weeklyUserVisitor as $data) : ?> "<?= $data['totalVisitor'] ?>",
                            <?php endforeach; ?>
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    layout: {
                        padding: {
                            left: 15,
                            right: 15,
                            top: 15,
                            bottom: 15
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "500",
                                beginAtZero: false,
                                maxTicksLimit: 5,
                                padding: 20
                            },
                            gridLines: {
                                drawTicks: false,
                                display: false
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 20,
                                fontColor: "rgba(0,0,0,0.5)",
                                fontStyle: "500"
                            }
                        }]
                    },
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<ul class="' + chart.id + '-legend html-legend">');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
                            if (chart.data.datasets[i].label) {
                                text.push(chart.data.datasets[i].label);
                            }
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join('');
                    }
                }
            });

            var myLegendContainer = document.getElementById("myChartLegend");

            // generate HTML legend
            myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

            // bind onClick event to all LI-tags of the legend
            var legendItems = myLegendContainer.getElementsByTagName('li');
            for (var i = 0; i < legendItems.length; i += 1) {
                legendItems[i].addEventListener("click", legendClickCallback, false);
            }
        <?php
        endif;
        if ($value == 'bar') :
        ?>
            console.log('yourScriptHereToo');
    <?php
        endif;
    endforeach;
    ?>
</script>