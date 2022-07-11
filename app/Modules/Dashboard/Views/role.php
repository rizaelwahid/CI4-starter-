<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>
<?php

use Kint\Zval\Value;

if ($viewer == '') : ?>
    <form action="" method="GET">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <?= getPermission(['create', 'trash'], FALSE) ?>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <?php $requri   = \Config\Services::request(); ?>
                    <?php $segment1 = $requri->uri->getSegment(1); ?>
                    <?php $keyword  = $AppConf['request']->getVar('keyword'); ?>
                    <?php
                    if (!empty($keyword)) :
                    ?>
                        <div class="input-group-prepend">
                            <a href="/<?= $segment1 ?>" class="btn btn-danger" type="submit" id="button-addon2"><i class="fa fa-undo" aria-hidden="true"></i></a>
                        </div>
                    <?php endif; ?>
                    <input name="keyword" type="text" value="<?= (!empty($keyword)) ? $keyword : ''; ?>" class="form-control" placeholder="Search data ..." aria-label="Search data..." aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($role) : ?>
                    <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                    <?php foreach ($role as $data) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data['role']; ?></td>
                            <td>About <?= TimeAgo(strtotime($data['created_at'])); ?> ago</td>
                            <td class="text-center">
                                <?= getPermission(['access', 'permission', 'edit', 'delete'], $data['role_id']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <td colspan="8" class="text-center table-softgrey">No data shown.</td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row p-2">
        <div class="col-md-12 ">
            <?= $pager->links('role', 'custom_pagination') ?>
            <!-- ('namatable', 'customtemplate') -->
        </div>
    </div>
<?php elseif ($viewer == 'create') : ?>
    <form method="post" action="">
        <div class="form-group row">
            <label for="role" class="col-sm-2 col-form-label">Role Name</label>
            <div class="col-sm-10">
                <input value="<?= old('role'); ?>" type="text" name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?>" id="role" placeholder="Please input a role name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('role')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/role" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'edit') : ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="role" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input value="<?= (old('role')) ? old('role') : $role['role']; ?>" type="text" name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?>" id="role" placeholder="Please input a full name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('role')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/role" class="btn bn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn bn-sm btn-secondary">Update</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'trash') : ?>
    <form action="" method="GET">
        <div class="row">
            <div class="col-sm-4 mb-2">
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
    <!-- <form action="/role/harddelete/" method="POST">
    <?php csrf_field(); ?> -->
    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center">#</th>
                    <th>Role</th>
                    <th>Deleted</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($role) : ?>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($role as $data) : ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= $data['role']; ?></td>
                            <td><?= $data['deleted_at']; ?></td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-secondary mb-1" href="/role/restore/<?= $data['role_id']; ?>"><i class=" fas fa-fw fa-undo"></i></a>
                                <a class="btn btn-xs btn-danger mb-1" href="/role/harddelete/<?= $data['role_id']; ?>" data-toggle="modal" data-target="#deleteModal<?= $data['role_id']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                                <form action="/role/harddelete/<?= $data['role_id']; ?>" method="POST">
                                    <?php csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <div class="modal fade" id="deleteModal<?= $data['role_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel<?= $data['role_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel<?= $data['role_id']; ?>">Do you want to delete this data?</h5>
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
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <td colspan="4" class="text-center table-softgrey">No data shown.</td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row p-2">
        <div class="col-md-12 ">
            <?= $pager->links('role', 'custom_pagination') ?>
        </div>
    </div>
<?php endif; ?>

<div id=" loader">
</div>

<?= $this->endSection() ?>