<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>

<?php if ($viewer == '') : ?>
    <div class="mb-3">
        <?= getPermission(['create', 'trash'], FALSE) ?>
    </div>

    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th width="3%" class="text-center">#</th>
                    <th width="15%">Module</th>
                    <th>Access</th>
                    <th>Preview</th>
                    <th class="text-center">Active</th>
                    <th class="text-center">Permission</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php
                $arrayForTable = [];
                foreach ($permissions as $databaseValue) {
                    $temp = [];
                    $temp['permission_id']  = $databaseValue['permission_id'];
                    $temp['function']       = $databaseValue['function'];
                    $temp['title']          = $databaseValue['title'];
                    $temp['icon']           = $databaseValue['icon'];
                    $temp['color']          = $databaseValue['color'];
                    $temp['is_active']      = $databaseValue['is_active'];
                    if (!isset($arrayForTable[$databaseValue['menuTitle']])) {
                        $arrayForTable[$databaseValue['menuTitle']] = [];
                    }
                    $arrayForTable[$databaseValue['menuTitle']][] = $temp;
                }
                ?>
                <?php foreach ($arrayForTable as $group => $values) :
                    foreach ($values as $key => $value) : ?>
                        <tr>
                            <?php if ($key == 0) : ?>
                                <td class="text-center" rowspan="<?= count($values) ?>"><?= $i++ ?></td>
                                <td class="text-capitalize" rowspan="<?= count($values) ?>"><?= $group ?></td>
                            <?php endif; ?>
                            <td class="text-capitalize"><?= $value['function'] ?></td>
                            <td> <button class="btn btn-sm btn-<?= $value['color'] ?>" disabled><i class="<?= $value['icon']; ?>"></i> <?= $value['title'] ?></button></td>
                            <td class="text-center"><?= ($value['is_active'] == 1) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>'; ?></td>
                            <td class="text-center">
                                <?= getPermission(['edit', 'delete'], $value['permission_id']) ?>
                            </td>
                        </tr>
                <?php endforeach;
                endforeach; ?>
            </tbody>
        </table>
    </div>

<?php elseif ($viewer == 'create') : ?>

    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>

        <div class="form-group row">
            <label for="class" class="col-sm-2 col-form-label">Class</label>
            <div class="col-sm-10">
                <select id="select2" name="class" class="form-control" <?= ($validation->hasError('class')) ? 'is-invalid' : ''; ?>>
                    <?php foreach ($menu as $value) : ?>
                        <option value="<?= $value['menu_id']; ?>"><?= $value['title']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= ($validation->getError('class')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="function" class="col-sm-2 col-form-label">Function</label>
            <div class="col-sm-10">
                <input value="<?= old('function'); ?>" type="text" name="functionx" class="form-control <?= ($validation->hasError('function')) ? 'is-invalid' : ''; ?>" id="function" placeholder="Please input access function">
                <div class="invalid-feedback">
                    <?= ($validation->getError('function')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input value="<?= old('title'); ?>" type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" placeholder="Please input a title">
                <div class="invalid-feedback">
                    <?= ($validation->getError('title')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="icon" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-10">
                <input value="<?= old('icon'); ?>" type="text" name="icon" class="form-control <?= ($validation->hasError('icon')) ? 'is-invalid' : ''; ?>" id="icon" placeholder="Please input a icon">
                <div class="invalid-feedback">
                    <?= ($validation->getError('icon')); ?>
                </div>
                <div class="text-xs">
                    Need an idea? please visit<a class="text-decoration-none" href="https://fontawesome.com/v4.7.0/icons/" target="_blank"> this website.</a>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="color" class="col-sm-2 col-form-label">Color</label>
            <div class="col-sm-10">
                <div class="row gutters-xs">
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="dark" class="colorinput-input" <?= (old('color') == 'dark') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-black"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="primary" class="colorinput-input" <?= (old('color') == 'primary') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="secondary" class="colorinput-input" <?= (old('color') == 'secondary') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-secondary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="info" class="colorinput-input" <?= (old('color') == 'info') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-info"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="success" class="colorinput-input" <?= (old('color') == 'success') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-success"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="danger" class="colorinput-input" <?= (old('color') == 'danger') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-danger"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="warning" class="colorinput-input" <?= (old('color') == 'warning') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-warning"></span>
                        </label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('color')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/permission" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
            </div>
        </div>
    </form>

<?php elseif ($viewer == 'edit') : ?>

    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="class" class="col-sm-2 col-form-label">Class</label>
            <div class="col-sm-10">
                <select id="select2" name="class" class="form-control" <?= ($validation->hasError('class')) ? 'is-invalid' : ''; ?>>
                    <option value="<?= $permission['class']; ?>"><?= $permission['menuTitle']; ?></option>
                    <?php foreach ($menu as $value) : ?>
                        <option value="<?= $value['menu_id']; ?>"><?= $value['title']; ?></option>
                    <?php endforeach; ?>
                </select>
                <!-- <input value="<?= (old('class')) ? old('class') : $permission['class']; ?>" type="text" name="class" class="form-control <?= ($validation->hasError('class')) ? 'is-invalid' : ''; ?>" id="class" placeholder="Please input a module"> -->
                <div class="invalid-feedback">
                    <?= ($validation->getError('class')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="function" class="col-sm-2 col-form-label">Function</label>
            <div class="col-sm-10">
                <input value="<?= (old('function')) ? old('function') : $permission['function']; ?>" function="text" name="function" class="form-control <?= ($validation->hasError('function')) ? 'is-invalid' : ''; ?>" id="function" placeholder="Please input a access">
                <div class="invalid-feedback">
                    <?= ($validation->getError('function')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input value="<?= (old('title')) ? old('title') : $permission['title']; ?>" type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" placeholder="Please input a title">
                <div class="invalid-feedback">
                    <?= ($validation->getError('title')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="icon" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-10">
                <input value="<?= (old('icon')) ? old('icon') : $permission['icon']; ?>" type="text" name="icon" class="form-control <?= ($validation->hasError('icon')) ? 'is-invalid' : ''; ?>" id="icon" placeholder="Please input a icon">
                <div class="invalid-feedback">
                    <?= ($validation->getError('icon')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="color" class="col-sm-2 col-form-label">Color</label>
            <div class="col-sm-10">
                <div class="row gutters-xs">
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="dark" class="colorinput-input" <?= (old('color') == 'dark' || $permission['color'] == 'dark') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-black"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="primary" class="colorinput-input" <?= (old('color') == 'primary' || $permission['color'] == 'primary') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="secondary" class="colorinput-input" <?= (old('color') == 'secondary' || $permission['color'] == 'secondary') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-secondary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="info" class="colorinput-input" <?= (old('color') == 'info' || $permission['color'] == 'info') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-info"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="success" class="colorinput-input" <?= (old('color') == 'success' || $permission['color'] == 'success') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-success"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="danger" class="colorinput-input" <?= (old('color') == 'danger' || $permission['color'] == 'danger') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-danger"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="color" type="radio" value="warning" class="colorinput-input" <?= (old('color') == 'warning' || $permission['color'] == 'warning') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-warning"></span>
                        </label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('color')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="is_active" class="col-sm-2 col-form-label">Active Status</label>
            <div class="col-sm-10">
                <select name="is_active" class="form-control <?= ($validation->hasError('is_active')) ? 'is-invalid' : ''; ?>" id="is_active">
                    <option value="1" <?= ($permission['is_active'] == 1) ? 'selected = "selected"' : ''; ?>>True</option>
                    <option value="0" <?= ($permission['is_active'] == 0) ? 'selected = "selected"' : ''; ?>>False</option>
                </select>
                <div class="invalid-feedback">
                    <?= ($validation->getError('is_active')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/permission" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Update</button>
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

    <!-- <form action="/permission/harddelete/" method="POST">
            <?php csrf_field(); ?> -->
    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center">#</th>
                    <th>Module</th>
                    <th>Access</th>
                    <th>Title</th>
                    <th>Icon</th>
                    <th class="text-center">Active</th>
                    <th>Deleted</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($permissions) : ?>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php
                    $arrayForTable = [];
                    foreach ($permissions as $databaseValue) {
                        $temp = [];
                        $temp['permission_id']  = $databaseValue['permission_id'];
                        $temp['function']       = $databaseValue['function'];
                        $temp['title']          = $databaseValue['title'];
                        $temp['icon']           = $databaseValue['icon'];
                        $temp['is_active']      = $databaseValue['is_active'];
                        $temp['deleted_at']     = $databaseValue['deleted_at'];
                        if (!isset($arrayForTable[$databaseValue['class']])) {
                            $arrayForTable[$databaseValue['class']] = [];
                        }
                        $arrayForTable[$databaseValue['class']][] = $temp;
                    }
                    ?>
                    <?php foreach ($arrayForTable as $group => $values) :
                        foreach ($values as $key => $value) : ?>
                            <tr>
                                <?php if ($key == 0) : ?>
                                    <td class="text-center" rowspan="<?= count($values) ?>"><?= $i++ ?></td>
                                    <td class="text-capitalize" rowspan="<?= count($values) ?>"><?= $group ?></td>
                                <?php endif; ?>
                                <td class="text-capitalize"><?= $value['function'] ?></td>
                                <td><?= $value['title'] ?></td>
                                <td><?= $value['icon'] ?></td>
                                <td class="text-center"><?= ($value['is_active'] == 1) ? 'True' : 'False'; ?></td>
                                <td><?= $value['deleted_at'] ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-secondary mb-1" href="/permission/restore/<?= $value['permission_id']; ?>"><i class=" fas fa-fw fa-undo"></i></a>
                                    <a class="btn btn-sm btn-danger mb-1" href="/permission/harddelete/<?= $value['permission_id']; ?>" data-toggle="modal" data-target="#deleteModal<?= $value['permission_id']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                                    <form action="/permission/harddelete/<?= $value['permission_id']; ?>" method="POST">
                                        <?php csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <!-- Button trigger modal -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal<?= $value['permission_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel<?= $value['permission_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteLabel<?= $value['permission_id']; ?>">Do you want to delete this data?</h5>
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
                    <?php endforeach;
                    endforeach; ?>
                <?php else : ?>
                    <td colspan="8" class="text-center table-softgrey">No data shown.</td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row p-2">
        <div class="col-md-12 ">
            <?= $pager->links('permission', 'custom_pagination') ?>
        </div>
    </div>
<?php elseif ($viewer == 'permission') : ?>
    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center">#</th>
                    <th>Module</th>
                    <th>Access</th>
                    <?php foreach ($roles as $val) : ?>
                        <th class="text-center"><?= $val['role']; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php
                // Creating an array as per the need for the table
                $arrayForTable = [];
                foreach ($permission as $databaseValue) {
                    $temp = [];
                    $temp['function'] = $databaseValue['function'];
                    $temp['permission_id'] = $databaseValue['permission_id'];
                    if (!isset($arrayForTable[$databaseValue['menuTitle']])) {
                        $arrayForTable[$databaseValue['menuTitle']] = [];
                    }
                    $arrayForTable[$databaseValue['menuTitle']][] = $temp;
                }
                ?>
                <?php foreach ($arrayForTable as $group => $values) :
                    foreach ($values as $key => $value) : ?>
                        <tr>
                            <?php if ($key == 0) : ?>
                                <td class="text-center" rowspan="<?= count($values) ?>"><?= $i++ ?></td>
                                <td class="text-capitalize" rowspan="<?= count($values) ?>"><?= $group ?></td>
                            <?php endif; ?>
                            <td class="text-capitalize"><?= $value['function'] ?></td>
                            <?php foreach ($roles as $val) : ?>
                                <td class="text-center">
                                    <div class="switchbox">
                                        <input type="checkbox" class="switch" <?= checkPermission($val['role_id'], $value['permission_id']); ?> data-role="<?= $val['role_id']; ?>" data-permission="<?= $value['permission_id']; ?>">
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                <?php endforeach;
                endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div id="loader"></div>

<?= $this->endSection() ?>