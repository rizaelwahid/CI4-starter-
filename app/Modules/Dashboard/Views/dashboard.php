<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>
<!-- <table cellpadding="5" width="100%">
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
</table> -->

<div class="row">
    <div class="col-sm-7">
        <div class="card-title">Overall visitor</div>
        <div class="card-category">Information about visitor in system</div>
        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
            <div class="px-2 pb-2 pb-md-0 text-center">
                <div id="circles-1"></div>
                <h6 class="fw-bold mt-3 mb-0">Online</h6>
            </div>
            <div class="px-2 pb-2 pb-md-0 text-center">
                <div id="circles-2"></div>
                <h6 class="fw-bold mt-3 mb-0">Online User</h6>
            </div>
            <div class="px-2 pb-2 pb-md-0 text-center">
                <div id="circles-3"></div>
                <h6 class="fw-bold mt-3 mb-0">Online Guest</h6>
            </div>
            <div class="px-2 pb-2 pb-md-0 text-center">
                <div id="circles-4"></div>
                <h6 class="fw-bold mt-3 mb-0">Today</h6>
            </div>
            <div class="px-2 pb-2 pb-md-0 text-center">
                <div id="circles-5"></div>
                <h6 class="fw-bold mt-3 mb-0">Yesterday</h6>
            </div>
            <div class="px-2 pb-2 pb-md-0 text-center">
                <div id="circles-6"></div>
                <h6 class="fw-bold mt-3 mb-0">All Time</h6>
            </div>
        </div>

        <div class="separator-solid"></div>

        <div class="card-title">This week visitor</div>
        <div class="card-category">Information about visitor in system</div>
        <div class="chart-container">
            <canvas id="htmlLegendsChart"></canvas>
        </div>
        <div id="myChartLegend"></div>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, itaque? Vero deleniti similique natus autem voluptatem enim quam, delectus cumque doloremque, provident pariatur aut. Ad voluptas quidem voluptatum doloremque deserunt.
    </div>
    <div class="col-sm-5">
        <div class="card card-primary bg-primary-gradient">
            <div class="card-body">
                <h4 class="mt-2 b-b1 pb-2 mb-4 fw-bold">Current online user</h4>
                <p class="demo">
                <div class="avatar-group">
                    <?php foreach ($nameVisitor as $data) : ?>
                        <div class="avatar avatar-online">
                            <a href="/user/view/<?= $data['user_id']; ?>" target="_blank">
                                <img src="/assets/images/avatar/<?= $data['avatar']; ?>" alt="<?= $data['username']; ?>" class="avatar-img rounded-circle border border-white">
                            </a>
                        </div>
                    <?php endforeach; ?>
                    <?php if ($onlineVisitor > 10) : ?>
                        <div class="avatar avatar-online">
                            <a href="" target="_blank">
                                <span class="avatar-title rounded-circle border border-white">+<?= $onlineVisitor - 1; ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                </p>
            </div>
        </div>
        <?php if ($activityLog) : ?>
            <div class="card-title">User log activity</div>
            <div class="card-category">Information data about activity in system</div>
            <ol class="activity-feed">
                <?php foreach ($activityLog as $data) : ?>
                    <li class="feed-item">
                        <time class="date"><?= date("l, d F Y h:i:s A", strtotime($data['created_at'])); ?></time>
                        <a class="text-decoration-none" href="/user/profile/<?= $data['user_id']; ?>"><?= $data['name']; ?></a> <?= $data['activity']; ?> <a class="text-decoration-none" href="<?= $data['menu_id']; ?>"><?= $data['title']; ?></a> about <?= TimeAgo(strtotime($data['created_at'])); ?> ago.
                        <span class="text"></span>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
</div>

<div id="loader"></div>

<?= $this->endSection() ?>