<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>
<?php

$request = \Config\Services::request();

if ($viewer == '') : ?>
    <form action="" method="GET">
        <div class="row">
            <div class="col-sm-4">
                <a href="" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-danger mt-1" title="Delete Data" data-toggle="tooltip"><i class="ss"></i> Delete Data</a>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input name="keyword" type="text" class="form-control" placeholder="Search data..." aria-label="Search data..." aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Go!</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="/activitylog/delete" method="POST">
        <?php csrf_field(); ?>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-light">
                    <tr>
                        <th class="text-center" style="width: 2px;">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input check_all" type="checkbox">
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </th>
                        <th class="text-center" style="width: 2px;">#</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($activityLog) : ?>
                        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                        <?php foreach ($activityLog as $data) : ?>
                            <tr>
                                <td class="text-center">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input check_boxes" name="activity_id[]" type="checkbox" value="<?= $data["activity_id"]; ?>">
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </td>
                                <td class="text-center"><?= $i++; ?></td>
                                <td>
                                    <a class="text-decoration-none" href="/user/view/<?= $data['user_id']; ?>"><?= $data['name']; ?> </a> <a class="text-decoration-none" href="<?= $data['reference_id']; ?>"><?= $data['activity']; ?></a> module <?= $data['title']; ?> about <?= TimeAgo(strtotime($data['created_at'])); ?> ago.
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <td colspan="8" class="text-center table-softgrey">No data shown.</td>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLabel">Do you want to delete this data?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Delete" below if you are sure to erase the data.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row p-2">
        <div class="col-md-12 ">
            <?= $pager->links('activity_log', 'custom_pagination') ?>
        </div>
    </div>
<?php elseif ($viewer == 'create') : ?>

<?php endif; ?>

<div id=" loader">
</div>

<?= $this->endSection() ?>