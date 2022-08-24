<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= $title; ?> | <?= $AppConf['siteName']; ?></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


    <link rel="stylesheet" href="/assets/layouts/ace/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/ace/css/jquery-ui.custom.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/ace/css/ace.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/ace/css/ace-skins.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/ace/css/ace-rtl.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/ace/css/simpeg-custome.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/fonts/fontawesome/4.5.0/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/layouts/css/fonts.googleapis.com.css" type="text/css" />

    <!-- CSS Plugin -->
    <?= $this->include('\Modules\Dashboard\Views\Layout\css'); ?>

    <style type="text/css">
        .overlay {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
            background: rgba(255, 255, 255, 0.8) url("/assets/layouts/ace/images/loader.gif") center no-repeat;
        }

        /* Turn off scrollbar when body element has the loading class */
        body.loading {
            overflow: hidden;
        }

        /* Make spinner image visible when body element has the loading class */
        body.loading .overlay {
            display: block;
        }

        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url("/assets/layouts/ace/images/loader.gif") no-repeat center center;
            z-index: 10000;
        }
    </style>
</head>

<body class="skin-2">
    <div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left">
                <a href="/dashboard/" class="navbar-brand">
                    <small>
                        <i class="fa fa-group"></i>
                        SIMPEG
                    </small>
                </a>
            </div>

            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="grey dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-tasks"></i>
                            <span class="badge badge-grey">0</span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-check"></i>
                                0 Tasks to complete
                            </li>

                            <li class="dropdown-content">
                            </li>

                            <li class="dropdown-footer">
                                <a href="#">
                                    See tasks with details
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                            <span class="badge badge-important">0</span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-exclamation-triangle"></i>
                                0 Notifications
                            </li>

                            <li class="dropdown-content">
                                <ul class="dropdown-menu dropdown-navbar">
                                    <li>
                                        <a href="http://simpeg.pelalawankab.go.id/opd_pengajuankgb/detail_periode/2-juni-2021/" class="clearfix">
                                            <span class="msg-body" style="margin-left: 0px">
                                                <span class="msg-title">
                                                    <span class="blue"><strong>Admin</strong>:</span>
                                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quidem facilis porro laboriosam placeat ut similique tempore, assumenda pariatur, nobis sequi obcaecati error non! Officiis enim perspiciatis voluptatibus deserunt eum ex. </span>

                                                <span class="msg-time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span>10 Jun 2021 12:24:19</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://simpeg.pelalawankab.go.id/opd_pengajuankgb/detail_periode/2-juni-2021/" class="clearfix">
                                            <span class="msg-body" style="margin-left: 0px">
                                                <span class="msg-title">
                                                    <span class="blue"><strong>Admin</strong>:</span>
                                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Exercitationem similique voluptatum dignissimos error aliquid deserunt delectus repellat ad dolorum aliquam. Eveniet odio consequatur culpa laborum est a amet corporis nesciunt </span>

                                                <span class="msg-time">
                                                    <i class="ace-icon fa fa-clock-o"></i>
                                                    <span>09 Jun 2021 15:51:27</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-footer">
                                <a href="#">
                                    See all notifications
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="green dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                            <span class="badge badge-success">0</span>
                        </a>

                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-envelope-o"></i>
                                0 Messages
                            </li>

                            <li class="dropdown-content">
                            </li>

                            <li class="dropdown-footer">
                                <a href="inbox.html">
                                    See all messages
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <img class="nav-user-photo" src="/assets/images/avatars/user.jpg " alt="Jason's Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                Arizal </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="/administrator_password/">
                                    <i class="ace-icon fa fa-key"></i>
                                    Ganti Password
                                </a>
                            </li>

                            <li>
                                <a href="/administrator_profile/">
                                    <i class="ace-icon fa fa-user"></i>
                                    Profile
                                </a>
                            </li>

                            <li class="divider"></li>

                            <li>
                                <a href="/logout/">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        <div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed sidebar-scroll">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {}
            </script>
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                    <button class="btn btn-success">
                        <i class="ace-icon fa fa-signal"></i>
                    </button>

                    <button class="btn btn-info">
                        <i class="ace-icon fa fa-pencil"></i>
                    </button>

                    <button class="btn btn-warning">
                        <i class="ace-icon fa fa-users"></i>
                    </button>

                    <button class="btn btn-danger">
                        <i class="ace-icon fa fa-cogs"></i>
                    </button>
                </div>

                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>

                    <span class="btn btn-info"></span>

                    <span class="btn btn-warning"></span>

                    <span class="btn btn-danger"></span>
                </div>
            </div><!-- /.sidebar-shortcuts -->

            <ul class="nav nav-list">
                <li class="active ">
                    <a href="/dashboard/">
                        <i class="menu-icon fa fa-tachometer"></i>
                        <span class="menu-text"> Dashboard </span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-at"></i>
                        <span class="menu-text"> Verifikasi Email </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/data_verifikasi_email/">
                                <i class="menu-icon fa fa-at"></i>
                                Data Verifikasi Email </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/email_goid/">
                                <i class="menu-icon fa fa-at"></i>
                                Email Go ID </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/email_double/">
                                <i class="menu-icon fa fa-at"></i>
                                Data Email Double </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-th-list"></i>
                        <span class="menu-text"> Notifikasi </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/notif_kgb/">
                                <i class="menu-icon fa "></i>
                                KGB </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/notif_dokudigi/">
                                <i class="menu-icon fa fa-report"></i>
                                Dokumen Digital </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/notif_skptahunan/">
                                <i class="menu-icon fa fa-clipboard"></i>
                                SKP Tahunan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pengajuan_kgb/">
                                <i class="menu-icon fa fa-tasks"></i>
                                Pengajuan KGB </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-copy"></i>
                        <span class="menu-text"> Kinerja </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/penilaian_kinerja/">
                                <i class="menu-icon fa fa-copy"></i>
                                Penilaian Kinerja </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/evaluasi_kj/">
                                <i class="menu-icon fa fa-copy"></i>
                                Evaluasi Kinerja Jabatan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/penilaian_kinerja_admin/">
                                <i class="menu-icon fa fa-envelope"></i>
                                Penilaian Kinerja (Admin) </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-cc"></i>
                        <span class="menu-text"> NOMOR SURAT </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/nomor_sppd/">
                                <i class="menu-icon fa fa-external-link-square"></i>
                                SPPD </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/nomor_sk/">
                                <i class="menu-icon fa fa-file-powerpoint-o"></i>
                                SK </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-cc"></i>
                        <span class="menu-text"> SIDARA KONFIG </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/sdr_laporanbulanan/">
                                <i class="menu-icon fa a-file-powerpoint-o"></i>
                                LAPORAN PEGAWAI </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-tasks"></i>
                        <span class="menu-text"> Pengajuan </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/opd_pengajuankgb/">
                                <i class="menu-icon fa fa-clipboard"></i>
                                Kenaikan Gaji Berkala </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/opd_pengajuankp/">
                                <i class="menu-icon fa fa-clipboard"></i>
                                Kenaikan Pangkat </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/opd_pengajuanmutasi/">
                                <i class="menu-icon fa fa-clipboard"></i>
                                Mutasi Dan Jabatan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/opd_pengajuankartu/">
                                <i class="menu-icon fa "></i>
                                Karpeg, Karis, Atau Karsu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/opd_pengajuanpensiun/">
                                <i class="menu-icon fa "></i>
                                Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-columns"></i>
                        <span class="menu-text"> Pelayanan </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/ply_kgb/">
                                <i class="menu-icon fa fa-clipboard"></i>
                                Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/ply_kp/">
                                <i class="menu-icon fa fa-signal"></i>
                                Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/ply_mutasi/">
                                <i class="menu-icon fa fa-signal"></i>
                                Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/ply_kartu/">
                                <i class="menu-icon fa "></i>
                                Karpeg, Karis, Atau Karsu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/ply_pensiun/">
                                <i class="menu-icon fa "></i>
                                Pensiun (P) </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Approval Kasubbid </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/kasubbid_app_kgb/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kasubbid Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/kasubbid_app_kp/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kasubbid Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_kasubbid_app/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kasubbid Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/krt_kasubbid_app/">
                                <i class="menu-icon fa fa-signal"></i>
                                Kasubbid Karpeg, Karis, Atau Karsu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pns_kasubbid_app/">
                                <i class="menu-icon fa "></i>
                                Kasubbid Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Approval Kabid </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/kabid_app_kgb/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kabid Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/kabid_app_kp/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kabid Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_kabid_app/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kabid Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/krt_kabid_app/">
                                <i class="menu-icon fa fa-signal"></i>
                                Kabid Karpeg, Karis, Atau Karsu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pns_kabid_app/">
                                <i class="menu-icon fa "></i>
                                Kabid Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Approval Sekretaris </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/app_sekretaris_kgb/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Sekertaris Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/app_sekretaris_kp/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Sekertaris Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_sekretaris_app/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Sekertaris Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/krt_sekretaris_app/">
                                <i class="menu-icon fa fa-signal"></i>
                                Sekretaris Karpeg, Karis, Atau Karsu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pns_sekretaris_app/">
                                <i class="menu-icon fa "></i>
                                Sekretaris Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Approval Kaban </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/app_kaban_kgb/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kaban Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/app_kaban_kp/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kaban Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_kaban_app/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Kaban Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/krt_kaban_app/">
                                <i class="menu-icon fa fa-signal"></i>
                                Kaban Karpeg, Karis, Atau Karsu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pns_kaban_app/">
                                <i class="menu-icon fa "></i>
                                Kaban Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Approval Asisten III </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/app_asisten_kgb/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                A3 Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/app_asisten_kp/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                A3 Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_asistentiga_app/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                A3 Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Approval Setda </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/app_setda_kgb/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Setda Kenaikan Gaji Berkala (KGB) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/app_setda_kp/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Setda Kenaikan Pangkat (KP) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_setda_app/">
                                <i class="menu-icon fa fa-gg-circle"></i>
                                Setda Mutasi Dan Jabatan (MJ) </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pns_sekda_app/">
                                <i class="menu-icon fa "></i>
                                Setda Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-gg-circle"></i>
                        <span class="menu-text"> Bagian Hukum </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/pns_hukum_app/">
                                <i class="menu-icon fa "></i>
                                Bagian Hukum Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/mti_bagianhukum_app/">
                                <i class="menu-icon fa "></i>
                                Bagian Hukum Mutasi </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-table"></i>
                        <span class="menu-text"> Master Tabel </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/tabel_agama/">
                                <i class="menu-icon fa fa-moon-o"></i>
                                Tabel Agama </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/tabel_bahasa/">
                                <i class="menu-icon fa fa-language"></i>
                                Tabel Bahasa </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/tabel_pendidikan/">
                                <i class="menu-icon fa fa-mortar-board"></i>
                                Tabel Pendidikan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/tabel_jurusan/">
                                <i class="menu-icon fa fa-tags"></i>
                                Tabel Jurusan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/tabel_pekerjaan/">
                                <i class="menu-icon fa fa-institution"></i>
                                Tabel Pekerjaan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/#/">
                                <i class="menu-icon fa fa"></i>
                                ------------------------------ </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/spp/">
                                <i class="menu-icon fa fa"></i>
                                SPP </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/unit_kerja/">
                                <i class="menu-icon fa fa"></i>
                                Unit Kerja </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/spp_non_pelalawan/">
                                <i class="menu-icon fa fa"></i>
                                SPP Non Pelalawan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/unit_kerja_non_pelalawan/">
                                <i class="menu-icon fa fa"></i>
                                Unit Kerja Non Pelalawan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/#/">
                                <i class="menu-icon fa fa"></i>
                                ------------------------------ </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/instansi_induk/">
                                <i class="menu-icon fa fa"></i>
                                Instansi Induk </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/status_kepegawaian/">
                                <i class="menu-icon fa fa"></i>
                                Status Kepegawaian </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/jenis_kepegawaian/">
                                <i class="menu-icon fa fa"></i>
                                Jenis Kepegawaian </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/kedudukan_kepegawaian/">
                                <i class="menu-icon fa fa"></i>
                                Kedudukan Kepegawaian </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/diklat/">
                                <i class="menu-icon fa fa"></i>
                                Diklat </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/perbendaharaan/">
                                <i class="menu-icon fa fa"></i>
                                Perbendaharaan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/tanda_jasa/">
                                <i class="menu-icon fa fa"></i>
                                Tanda Jasa </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/tugas_luar_negeri/">
                                <i class="menu-icon fa fa"></i>
                                Tugas Luar Negeri </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/hukuman/">
                                <i class="menu-icon fa fa"></i>
                                Hukuman </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/#/">
                                <i class="menu-icon fa fa"></i>
                                ------------------------------ </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pangkat_golongan/">
                                <i class="menu-icon fa fa"></i>
                                Pangkat/Golongan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/eselon/">
                                <i class="menu-icon fa fa"></i>
                                Eselon </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/jabatan/">
                                <i class="menu-icon fa fa"></i>
                                Jabatan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/jenis_jabatan/">
                                <i class="menu-icon fa fa"></i>
                                Jenis Jabatan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/pejabat/">
                                <i class="menu-icon fa fa"></i>
                                Pejabat </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/persyaratan/">
                                <i class="menu-icon fa "></i>
                                Persyaratan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/#/">
                                <i class="menu-icon fa fa"></i>
                                ----------------------------- </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/#/">
                                <i class="menu-icon fa fa"></i>
                                ----------------------------- </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/region/">
                                <i class="menu-icon fa fa-map"></i>
                                Region </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="/data_pegawai/" class="">
                        <i class="menu-icon fa fa-group"></i>
                        <span class="menu-text"> Data Pegawai </span>
                    </a>
                </li>
                <li class="">
                    <a href="/data_honorer/" class="">
                        <i class="menu-icon fa fa-group"></i>
                        <span class="menu-text"> Data Honorer </span>
                    </a>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-newspaper-o"></i>
                        <span class="menu-text"> Laporan </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/laporan_duk/">
                                <i class="menu-icon fa fa"></i>
                                Daftar Urut Kepangkatan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/riwayat_hidup/">
                                <i class="menu-icon fa fa"></i>
                                Riwayat Hidup </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/daftar_riwayat_pns_mutasi_pebsiun_dan_meninggal/">
                                <i class="menu-icon fa fa"></i>
                                Daftar Riwayat PNS Mutasi, Pensiun dan Meninggal </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_cpns/">
                                <i class="menu-icon fa fa"></i>
                                @CPNS </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_pns/">
                                <i class="menu-icon fa fa"></i>
                                @PNS </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_Pejabat_Struktural/">
                                <i class="menu-icon fa fa"></i>
                                @ Pejabat Struktural </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_Pejabat_Fungsional/">
                                <i class="menu-icon fa fa"></i>
                                @ Pejabat Fungsional </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_Kenaikan_Pangkat_PNS/">
                                <i class="menu-icon fa fa"></i>
                                @ Kenaikan Pangkat PNS </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_pns_yang_akan_pensiun/">
                                <i class="menu-icon fa fa"></i>
                                @ PNS Yang Akan Pensiun </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_pns_yang_sudah_pensiun/">
                                <i class="menu-icon fa fa"></i>
                                @ PNS yang sudah pensiun </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_alumni_diklat_kepemimpinan/">
                                <i class="menu-icon fa fa"></i>
                                @ Alumni Diklat Kepemimpinan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_alumni_diklat_kepemimpinan_blm_menjabat/">
                                <i class="menu-icon fa fa"></i>
                                @ Alumni Diklat Kepemimpinan Blm Menjabat </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_pns_belum_diklat_pim/">
                                <i class="menu-icon fa fa"></i>
                                @ PNS Belum Diklat PIM </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_daftar_alumni_pendidikan_umum/">
                                <i class="menu-icon fa fa"></i>
                                @ Daftar Alumni Pendidikan Umum </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_penerima_satya_lencana/">
                                <i class="menu-icon fa fa"></i>
                                @ Penerima Satya Lencana </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_penerima_penghargaan_lainnya/">
                                <i class="menu-icon fa fa"></i>
                                @ Penerima Penghargaan lainnya </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_masa_kerja_eselon/">
                                <i class="menu-icon fa fa"></i>
                                @ Masa Kerja Eselon </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_masa_kerja_pns/">
                                <i class="menu-icon fa fa"></i>
                                @ Masa Kerja PNS </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_tugas_belajar/">
                                <i class="menu-icon fa fa"></i>
                                @ Tugas Belajar </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_meninggal/">
                                <i class="menu-icon fa fa"></i>
                                @ Meninggal </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_mutasi/">
                                <i class="menu-icon fa fa"></i>
                                @ Mutasi </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_eselonering/">
                                <i class="menu-icon fa fa"></i>
                                @ Laporan Eselonering </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_eselonering_new/">
                                <i class="menu-icon fa fa-map"></i>
                                @ Laporan Eselonering - New </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_grafik_eselon/">
                                <i class="menu-icon fa fa"></i>
                                @ Grafik Eselon </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_grafik_golongan/">
                                <i class="menu-icon fa fa"></i>
                                @ Grafik Golongan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/rekapitulasi/">
                                <i class="menu-icon fa fa"></i>
                                Rekapitulasi </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_per_kolom/">
                                <i class="menu-icon fa fa"></i>
                                Laporan per kolom </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/rekapitulasi_per_kolom/">
                                <i class="menu-icon fa fa"></i>
                                Rekapitulasi per kolom </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_honorer/">
                                <i class="menu-icon fa fa"></i>
                                Laporan Honorer </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/laporan_keseluruhan/">
                                <i class="menu-icon fa fa"></i>
                                Laporan Keseluruhan </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/backup_laporan/">
                                <i class="menu-icon fa fa"></i>
                                Backup Laporan </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="//" class="">
                        <i class="menu-icon fa fa-gear"></i>
                        <span class="menu-text"> Pengaturan </span>
                    </a>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-user-secret"></i>
                        <span class="menu-text"> Administrator </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/user/">
                                <i class="menu-icon fa fa-user"></i>
                                User Admin </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/group_admin/">
                                <i class="menu-icon fa fa-group"></i>
                                Admin Group </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
                <li class="">
                    <a href="" class="dropdown-toggle">
                        <i class="menu-icon fa fa-connectdevelop"></i>
                        <span class="menu-text"> Developer </span>
                        <b class="arrow fa fa-angle-down"></b> </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li class="">
                            <a href="/menu/">
                                <i class="menu-icon fa fa-bars"></i>
                                Menu </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/administrator/">
                                <i class="menu-icon fa fa-user"></i>
                                Administrator </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/group_administrator/">
                                <i class="menu-icon fa fa-group"></i>
                                Group Administrator </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="//">
                                <i class="menu-icon fa fa-user"></i>
                                User Access Control </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/run_script/">
                                <i class="menu-icon fa fa-code"></i>
                                Run Script </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="//">
                                <i class="menu-icon fa fa-users"></i>
                                Group Access Control </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="/carabuatpdfexcel/">
                                <i class="menu-icon fa fa-ticket"></i>
                                Cara Buat PDF Dan Excel </a>
                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>
            </ul><!-- /.nav-list -->

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>

        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="/dashboard/">Home</a>
                        </li>
                        <li class="active"></li>
                    </ul><!-- /.breadcrumb -->
                </div>

                <div class="page-content">
                    <div class="row"><br>
                        <!-- PAGE CONTENT BEGINS -->
                        <?= $this->renderSection('content'); ?>
                        <div id="loader"></div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->

        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">
                    <span class="bigger-120">
                        <span class="blue bolder"><?= $AppConf['siteName']; ?> </span>
                        <?= $AppConf['footerCaption']; ?></span>

                    &nbsp; &nbsp;
                    <span class="action-buttons">
                        <a href="#">
                            <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                        </a>

                        <a href="#">
                            <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->

    <!-- <![endif]-->

    <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>

    <script src="/assets/layouts/ace/js/jquery.min.js"></script>
    <script src="/assets/layouts/ace/js/ace-extra.min.js"></script>
    <script src="/assets/layouts/ace/js/bootstrap.min.js"></script>
    <script src="/assets/layouts/ace/js/ace-elements.min.js"></script>
    <script src="/assets/layouts/ace/js/ace.min.js"></script>
    <script src="/assets/layouts/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/assets/layouts/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- Plugin JS Here-->
    <?= $this->include('\Modules\Dashboard\Views\Layout\js'); ?>
</body>

</html>