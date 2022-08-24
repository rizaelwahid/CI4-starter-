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
                    <th class="text-center">#</th>
                    <th colspan="3">Title</th>
                    <th>Url</th>
                    <th>Icon</th>
                    <th class="text-center">Active</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($menuGrup as $menus) :
                ?>
                    <tr class="table-white text-muted">
                        <td class="text-left"><?= $i++; ?></td>
                        <td colspan="5"><?= $menus['title']; ?></td>
                        <td class="text-center"><?= ($menus['is_active'] == 1) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>'; ?></td>
                        <td class="text-center">
                            <?= getPermission(['edit', 'delete'], $menus['menu_id']) ?>
                        </td>
                    </tr>
                    <?php $j = 1; ?>
                    <?php foreach ($menus['menu'] as $menu) : ?>
                        <tr class="table-softgrey text-muted">
                            <td class=" text-left" colspan="2">
                                &nbsp;&#10073;&nbsp;
                                &#9866;&#9866;&nbsp;
                                <?= $j++; ?>
                            </td>
                            <td colspan="2"><?= $menu['title']; ?></td>
                            <td><?= $menu['url']; ?></td>
                            <td><?= $menu['icon']; ?></td>
                            <td class="text-center"><?= ($menu['is_active'] == 1) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>'; ?></td>
                            <td class="text-center">
                                <?= getPermission(['edit', 'delete'], $menu['menu_id']) ?>
                            </td>
                        </tr>
                        <?php $k = 1; ?>
                        <?php foreach ($menu['menusub'] as $menusub) : ?>
                            <tr class="table-grey text-muted">
                                <td class="text-left" colspan="3">
                                    <a>
                                        &nbsp;&#10073;&nbsp;
                                    </a>
                                    <a style="opacity: 0;">
                                        &#9866;&#9866;&nbsp;
                                    </a>
                                    <a>
                                        &nbsp;&#10073;&nbsp;
                                        &#9866;&#9866;&nbsp;
                                    </a>
                                    <?= $k++; ?>
                                </td>
                                <td><?= $menusub['title']; ?></td>
                                <td><?= $menusub['url']; ?></td>
                                <td><?= $menusub['icon']; ?></td>
                                <td class="text-center"><?= ($menusub['is_active'] == 1) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>'; ?></td>
                                <td class="text-center">
                                    <?= getPermission(['edit', 'delete'], $menusub['menu_id']) ?>
                                </td>
                            </tr> <?php $l = 1; ?>
                            <?php foreach ($menusub['menusubsub'] as $menusubsub) : ?>
                                <tr class="table-darkgrey text-muted">
                                    <td class="text-left" colspan="3">
                                        <a>
                                            &nbsp;&#10073;&nbsp;
                                        </a>
                                        <a style="opacity: 0;">
                                            &#9866;&#9866;&nbsp;
                                        </a>
                                        <a>
                                            &nbsp;&#10073;&nbsp;
                                        </a>
                                        <a style="opacity: 0;">
                                            &#9866;&#9866;&nbsp;
                                        </a>
                                        &nbsp;&#10073;&nbsp;
                                        &#9866;&#9866;&nbsp;
                                        <?= $l++; ?>
                                    </td>
                                    <td><?= $menusubsub['title']; ?></td>
                                    <td><?= $menusubsub['url']; ?></td>
                                    <td><?= $menusubsub['icon']; ?></td>
                                    <td class="text-center"><?= ($menusubsub['is_active'] == 1) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>'; ?></td>
                                    <td class="text-center">
                                        <?= getPermission(['edit', 'delete'], $menusubsub['menu_id']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- End Content -->
<?php elseif ($viewer == 'create') : ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="parent_id" class="col-sm-2 col-form-label">Parent</label>
            <div class="col-sm-10">
                <select id="autocomplete" name="parent_id" class="form-control" <?= ($validation->hasError('parent_id')) ? 'is-invalid' : ''; ?>>
                </select>
                <div class="invalid-feedback">
                    <?= ($validation->getError('parent_id')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input value="<?= old('title'); ?>" type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" placeholder="Please input a tittle">
                <div class="invalid-feedback">
                    <?= ($validation->getError('title')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">URL</label>
            <div class="col-sm-10">
                <input value="<?= old('url'); ?>" type="text" name="url" class="form-control <?= ($validation->hasError('url')) ? 'is-invalid' : ''; ?>" id="url" placeholder="Please input a URL">
                <div class="invalid-feedback">
                    <?= ($validation->getError('url')); ?>
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
                <div class="text-xs mt-2">
                    Need an idea? please <a class="text-decoration-none" href="https://fontawesome.com/v4.7.0/icons/" target="_blank">visit</a> the website.
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/menu" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'edit') : ?>
    <?php
    $requri = \Config\Services::request();
    $for = $requri->uri->getSegment(1);
    ?>
    <!-- Content -->
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <?php if ($parent != null) : ?>
            <div class="form-group row">
                <label for="parent_id" class="col-sm-2 col-form-label">Parent</label>
                <div class="col-sm-10">
                    <select id="autocomplete" name="parent_id" class="form-control" <?= ($validation->hasError('parent_id')) ? 'is-invalid' : ''; ?>>
                        <option value="<?= (old('parent_id')) ? old('parent_id') : $menu['parent_id']; ?>"><?= $parent['title']; ?></option>
                    </select>
                    <div class="invalid-feedback">
                        <?= ($validation->getError('parent_id')); ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <input type="text" name="parent_id" value="0" hidden>
        <?php endif; ?>
        <div class="form-group   row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input value="<?= (old('title')) ? old('title') : $menu['title']; ?>" type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" placeholder="Please input a full name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('title')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">URL</label>
            <div class="col-sm-10">
                <input value="<?= (old('url')) ? old('url') : $menu['url']; ?>" type="text" name="url" class="form-control <?= ($validation->hasError('url')) ? 'is-invalid' : ''; ?>" id="url" placeholder="Please input a URL">
                <div class="invalid-feedback">
                    <?= ($validation->getError('url')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="icon" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-10">
                <input value="<?= (old('icon')) ? old('icon') : $menu['icon']; ?>" type="text" name="icon" class="form-control <?= ($validation->hasError('icon')) ? 'is-invalid' : ''; ?>" id="icon" placeholder="Please input a Icon">
                <div class="invalid-feedback">
                    <?= ($validation->getError('icon')); ?>
                </div>
                <div class="text-xs mt-2">
                    Need an idea? please <a class="text-decoration-none" href="https://fontawesome.com/v4.7.0/icons/" target="_blank">visit</a> the website.
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="is_active" class="col-sm-2 col-form-label">Active Status</label>
            <div class="col-sm-10">
                <select name="is_active" class="form-control <?= ($validation->hasError('is_active')) ? 'is-invalid' : ''; ?>" id="is_active">
                    <option value="1" <?= ($menu['is_active'] == 1) ? 'selected = "selected"' : ''; ?>>True</option>
                    <option value="0" <?= ($menu['is_active'] == 0) ? 'selected = "selected"' : ''; ?>>False</option>
                </select>
                <div class="invalid-feedback">
                    <?= ($validation->getError('is_active')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/menu" class="btn btn-sm btn-warning">Cancle</a>
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
    <?php csrf_field(); ?>
    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center">#</th>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Icon</th>
                    <th class="text-center">For</th>
                    <th class="text-center">Deleted</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($menu) : ?>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php foreach ($menu as $data) : ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?= $data['title']; ?></td>
                            <td><?= $data['url']; ?></td>
                            <td><?= $data['icon']; ?></td>
                            <td><?= $data['module']; ?></td>
                            <td><?= $data['deleted_at']; ?></td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-secondary mb-1" href="/menu/restore/<?= $data['menu_id']; ?>"><i class=" fas fa-fw fa-undo"></i></a>
                                <a class="btn btn-xs btn-danger mb-1" href="/menu/harddelete/<?= $data['menu_id']; ?>" data-toggle="modal" data-target="#deleteModal<?= $data['menu_id']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                                <form action="/menu/harddelete/<?= $data['menu_id']; ?>" method="POST">
                                    <?php csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <!-- Button trigger modal -->

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?= $data['menu_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel<?= $data['menu_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel<?= $data['menu_id']; ?>">Do you want to delete this data?</h5>
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
                    <td colspan="7" class="text-center table-softgrey">No data shown.</td>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="row p-2">
        <div class="col-md-12 ">
            <?= $pager->links('menu', 'custom_pagination') ?>
        </div>
    </div>
<?php elseif ($viewer == 'access') : ?>
    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center">#</th>
                    <th>Menu</th>

                    <?php foreach ($roles as $value) : ?>
                        <th class="text-center"><?= $value['role']; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($menuGrup as $menus) :
                ?>
                    <tr class="table-white text-muted">
                        <td class="text-left"><?= $i++; ?></td>
                        <td><?= $menus['title']; ?></td>
                        <?php foreach ($roles as $value) : ?>
                            <td class="text-center">
                                <div class="form-group">
                                    <div class="switchbox">
                                        <input type="checkbox" class="switch" <?= checkAccess($value['role_id'], $menus['menu_id']); ?> data-role="<?= $value['role_id']; ?>" data-menu="<?= $menus['menu_id']; ?>">
                                    </div>
                                </div>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                    <?php $j = 1; ?>
                    <?php foreach ($menus['menu'] as $menu) : ?>
                        <tr class="table-softgrey text-muted">
                            <td class=" text-left">
                                &nbsp;&#10073;&nbsp;
                                &#9866;&#9866;&nbsp;
                                <?= $j++; ?>
                            </td>
                            <td><?= $menu['title']; ?></td>
                            <?php foreach ($roles as $value) : ?>
                                <td class="text-center">
                                    <div class="form-group">
                                        <div class="switchbox">
                                            <input type="checkbox" class="switch" <?= checkAccess($value['role_id'], $menu['menu_id']); ?> data-role="<?= $value['role_id']; ?>" data-menu="<?= $menu['menu_id']; ?>">
                                        </div>
                                    </div>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php $k = 1; ?>
                        <?php foreach ($menu['menusub'] as $menusub) : ?>
                            <tr class="table-grey text-muted">
                                <td class="text-left">
                                    <a>
                                        &nbsp;&#10073;&nbsp;
                                    </a>
                                    <a style="opacity: 0;">
                                        &#9866;&#9866;&nbsp;
                                    </a>
                                    <a>
                                        &nbsp;&#10073;&nbsp;
                                        &#9866;&#9866;&nbsp;
                                    </a>
                                    <?= $k++; ?>
                                </td>
                                <td><?= $menusub['title']; ?></td>
                                <?php foreach ($roles as $value) : ?>
                                    <td class="text-center">
                                        <div class="switchbox">
                                            <input type="checkbox" class="switch" <?= checkAccess($value['role_id'], $menusub['menu_id']); ?> data-role="<?= $value['role_id']; ?>" data-menu="<?= $menusub['menu_id']; ?>">
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                            <?php $l = 1; ?>
                            <?php foreach ($menusub['menusubsub'] as $menusubsub) : ?>
                                <tr class="table-darkgrey text-muted">
                                    <td class="text-left">
                                        <a>
                                            &nbsp;&#10073;&nbsp;
                                        </a>
                                        <a style="opacity: 0;">
                                            &#9866;&#9866;&nbsp;
                                        </a>
                                        <a>
                                            &nbsp;&#10073;&nbsp;
                                        </a>
                                        <a style="opacity: 0;">
                                            &#9866;&#9866;&nbsp;
                                        </a>
                                        <a>
                                            &nbsp;&#10073;&nbsp;
                                            &#9866;&#9866;&nbsp;
                                        </a>
                                        <?= $l++; ?>
                                    </td>
                                    <td><?= $menusubsub['title']; ?></td>
                                    <?php foreach ($roles as $value) : ?>
                                        <td class="text-center">
                                            <div class="switchbox">
                                                <input type="checkbox" class="switch" <?= checkAccess($value['role_id'], $menusubsub['menu_id']); ?> data-role="<?= $value['role_id']; ?>" data-menu="<?= $menusubsub['menu_id']; ?>">
                                            </div>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div id="loader"></div>

<?= $this->endSection() ?>