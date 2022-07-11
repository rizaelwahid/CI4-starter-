<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>
<table cellpadding="5" width="100%">
    <tr>
        <td>
            <label><strong>Engine</strong></label>
            <div class="value">Codeigniter <?= \CodeIgniter\CodeIgniter::CI_VERSION; ?></div>

        </td>
        <td>
            <label><strong>License</strong></label>
            <div class="value"><a href="/" target="_blank">Simpeg</a></div>

        </td>
        <td>
            <label><strong>Bahasa Pemrograman</strong></label>
            <div class="value">PHP <?= phpversion(); ?></div>

        </td>
    </tr>
    <tr>
        <td>
            <label><strong>Webserver</strong></label>
            <div class="value">
                Apache/2.4.38 </div>
            </div>
        </td>
        <td>
            <label><strong>Database</strong></label>
            <div class="value">
                MySQL 5.5.5-10.1.38-MariaDB </div>
            </div>
        </td>
    </tr>
</table>
<div id="loader"></div>

<?= $this->endSection() ?>