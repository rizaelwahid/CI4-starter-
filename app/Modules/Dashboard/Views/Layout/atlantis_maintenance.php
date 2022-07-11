<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title; ?> | <?= $AppConf['SiteName']; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/layouts/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/layouts/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['/assets/layouts/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/layouts/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/layouts/atlantis/css/atlantis.css">
    <link rel="stylesheet" href="/assets/layouts/css/custome.css" type="text/css" />
</head>

<body class="page-not-found">
    <div class="wrapper not-found bg-primary-gradient">
        <h1 class="animated fadeIn">Maintenance!</h1>
        <h5 class="animated fadeInUp">Estimate Time:</h5>
        <div id="timer" class="flex-wrap d-flex justify-content-center animated fadeIn">
            <div id="days" class="align-items-center flex-column d-flex justify-content-center"></div>
            <div id="hours" class="align-items-center flex-column d-flex justify-content-center"></div>
            <div id="minutes" class="align-items-center flex-column d-flex justify-content-center"></div>
            <div id="seconds" class="align-items-center flex-column d-flex justify-content-center"></div>
        </div>
        <div class="desc animated fadeIn"><br />The site is under maintenance, please come back again later.</div>
        <a onclick="history.back()" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
            <span class="btn-label mr-2">
                <i class="flaticon-left-arrow-4"></i>
            </span>
            Try Back To Previous Page
        </a>
    </div>

    <script src="/assets/layouts/js/core/jquery.3.2.1.min.js"></script>
    <script src="/assets/layouts/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/layouts/js/core/popper.min.js"></script>
    <script src="/assets/layouts/js/core/bootstrap.min.js"></script>
    <script src="/assets/layouts/atlantis/js/atlantis.min.js"></script>

    <script>
        function makeTimer() {
            var endTime = new Date("<?= date('F j, Y H:i:s', strtotime($AppConf['isMaintenance'])) ?>");
            var endTime = (Date.parse(endTime)) / 1000;
            var now = new Date();
            var now = (Date.parse(now) / 1000);
            var timeLeft = endTime - now;
            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));
            if (hours < "10") {
                hours = "0" + hours;
            }
            if (minutes < "10") {
                minutes = "0" + minutes;
            }
            if (seconds < "10") {
                seconds = "0" + seconds;
            }
            $("#days").html(days + "<span>Days</span>");
            $("#hours").html(hours + "<span>Hours</span>");
            $("#minutes").html(minutes + "<span>Minutes</span>");
            $("#seconds").html(seconds + "<span>Seconds</span>");
        }
        setInterval(function() {
            makeTimer();
        }, 0);
    </script>
</body>

</html>