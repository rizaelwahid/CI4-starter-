<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>

<div class="material-panel default">
    <div class="head">
        <h5>
            <strong>Informasi Sistem</strong>
        </h5>
    </div>
    <div class="body">
        <table cellpadding="5" width="100%">
            <tr>
                <td>
                    <div class="item">
                        <label><strong>Engine</strong></label>
                        <div class="value">Codeigniter 4 v.<?= \CodeIgniter\CodeIgniter::CI_VERSION; ?></div>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <label><strong>License</strong></label>
                        <div class="value"><a href="/" target="_blank">Simpeg</a></div>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <label><strong>Bahasa Pemrograman</strong></label>
                        <div class="value">PHP <?= phpversion(); ?></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="item">
                        <label><strong>Webserver</strong></label>
                        <div class="value">
                            Apache/2.4.38 </div>
                    </div>
                </td>
                <td>
                    <div class="item">
                        <label><strong>Database</strong></label>
                        <div class="value">
                            MySQL 5.5.5-10.1.38-MariaDB </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="loader"></div>

<?= $this->endSection() ?>