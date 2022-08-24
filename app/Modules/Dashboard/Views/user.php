<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>
<?php $request = \Config\Services::request(); ?>
<?php helper('cookie'); ?>
<?php if ($viewer == '') : ?>
    <form action="" method="GET">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <?= getPermission(['create', 'trash'], FALSE) ?>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <?php $segment1 = $request->uri->getSegment(1); ?>
                    <?php $keyword  = $request->getVar('keyword'); ?>
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
                    <th class="text-center">Avatar</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Join</th>
                    <th class="text-center">Active</th>
                    <th class="text-center" style="width: 16.66%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($user) : ?>
                    <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                    <?php foreach ($user as $data) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <div class="avatar avatar-offline">
                                    <img src="/assets/images/avatar/<?= $data['avatar']; ?>" alt="<?= $data['avatar']; ?>" class="avatar-img rounded-circle">
                                </div>
                            </td>
                            <td><?= $data['name']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['role']; ?></td>
                            <td>About <?= TimeAgo(strtotime($data['created_at'])); ?> ago</td>
                            <td class="text-center"><?= ($data['is_active'] == 1) ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-danger">False</span>'; ?></td>
                            <td class="text-center">
                                <?= getPermission(['view', 'resetpassword', 'edit', 'delete'], $data['user_id']) ?>
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
            <?= $pager->links('user', 'custom_pagination') ?>
        </div>
    </div>
<?php elseif ($viewer == 'create') : ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input value="<?= old('name'); ?>" type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" placeholder="Please input a full name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('name')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="username" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
                <input value="<?= old('username'); ?>" type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" placeholder="Please input a username">
                <div class="invalid-feedback">
                    <?= ($validation->getError('username')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input value="<?= old('email'); ?>" type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="Please input a email">
                <div class="invalid-feedback">
                    <?= ($validation->getError('email')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input value="<?= old('password'); ?>" type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Please input a password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('password')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="confPassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input value="<?= old('confPassword'); ?>" type="confPassword" name="confPassword" class="form-control <?= ($validation->hasError('confPassword')) ? 'is-invalid' : ''; ?>" id="confPassword" placeholder="Please input a password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('confPassword')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
            <div class="col-sm-2">
                <img src="/assets/images/avatar/default.jpg" class="img-thumbnail img-preview" style="width: 300px;">
            </div>
            <div class="col-sm-8">
                <div class="custom-file">
                    <input type="file" name="avatar" class="custom-file-input <?= ($validation->hasError('avatar')) ? 'is-invalid' : ''; ?>" id="avatar" onchange="previewImg()">
                    <label class="custom-file-label" for="avatar" data-browse="Browse">Please choose a image</label>
                    <div class="invalid-feedback">
                        <?= ($validation->getError('avatar')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="role" class="col-sm-2 col-form-label">Role User</label>
            <div class="col-sm-10">
                <select name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?>" id="role">
                    <option value="">Choose a role for user</option>
                    <?php foreach ($getrole as $item) : ?>
                        <option value="<?= $item['role_id']; ?>" <?= (old('role') == $item['role_id']) ? 'selected = "selected"' : ''; ?>><?= $item['role']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= ($validation->getError('role')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/user" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Submit</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'edit') : ?>
    <?php if ($user['role'] == 'Super Admin' && session()->role_id != 1) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            No data can be shown.
            <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                <p class="mt--2 text-lg">&times;</p>
            </button>
        </div>
    <?php else : ?>
        <form method="post" action="" enctype="multipart/form-data">
            <?php csrf_field(); ?>
            <input type="hidden" name="avatarOld" value="<?= $user['avatar']; ?>">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input value="<?= (old('name')) ? old('name') : $user['name']; ?>" type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" id="name" placeholder="Please input a full name">
                    <div class="invalid-feedback">
                        <?= ($validation->getError('name')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input value="<?= (old('username')) ? old('username') : $user['username']; ?>" type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" placeholder="Please input a username">
                    <div class="invalid-feedback">
                        <?= ($validation->getError('username')); ?>
                    </div>
                </div>
            </div>
            <?php if (session()->role == 'Super Admin') : ?>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input value="<?= (old('email')) ? old('email') : $user['email']; ?>" type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" placeholder="Please input a email">
                        <div class="invalid-feedback">
                            <?= ($validation->getError('email')); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group row">
                <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                <div class="col-sm-2">
                    <img src="/assets/images/avatar/<?= $user['avatar']; ?>" class="img-thumbnail img-preview" style="width: 300px;">
                </div>
                <div class="col-sm-8">
                    <div class="custom-file">
                        <input type="file" name="avatar" class="custom-file-input <?= ($validation->hasError('avatar')) ? 'is-invalid' : ''; ?>" id="avatar" onchange="previewImg()">
                        <label class="custom-file-label" for="avatar" data-browse="Browse"><?= $user['avatar']; ?></label>
                        <div class="invalid-feedback">
                            <?= ($validation->getError('avatar')); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role User</label>
                <div class="col-sm-10">
                    <select name="role" class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?>" id="role">
                        <option value="">Choose a role for user</option>
                        <?php foreach ($getrole as $item) : ?>
                            <option value="<?= $item['role_id']; ?>" <?= ($user['role_id'] == $item['role_id']) ? 'selected = "selected"' : ''; ?>><?= $item['role']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= ($validation->getError('role')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="is_active" class="col-sm-2 col-form-label">Active Status</label>
                <div class="col-sm-10">
                    <select name="is_active" class="form-control <?= ($validation->hasError('is_active')) ? 'is-invalid' : ''; ?>" id="is_active">
                        <option value="1" <?= ($user['is_active'] == 1) ? 'selected = "selected"' : ''; ?>>True</option>
                        <option value="0" <?= ($user['is_active'] == 0) ? 'selected = "selected"' : ''; ?>>False</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= ($validation->getError('is_active')); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-md-2">
                    <a href="/user" class="btn btn-sm btn-warning">Cancle</a>
                    <button type="submit" class="btn btn-sm btn-secondary">Update</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
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

    <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
                <tr>
                    <th>#</th>
                    <th class="text-center">Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-center">Active</th>
                    <th>Deleted</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($user) : ?>
                    <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                    <?php foreach ($user as $data) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <div class="avatar avatar-offline">
                                    <img src="/assets/images/avatar/<?= $data['avatar']; ?>" alt="<?= $data['avatar']; ?>" class="avatar-img rounded-circle">
                                </div>
                            </td>
                            <td><?= $data['name']; ?></td>
                            <td><?= $data['email']; ?></td>
                            <td><?= $data['role']; ?></td>
                            <td class="text-center"><?= ($data['is_active'] == 1) ? 'True' : 'False'; ?></td>
                            <td><?= $data['deleted_at']; ?></td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-secondary mb-1" href="/user/restore/<?= $data['user_id']; ?>"><i class=" fas fa-fw fa-undo"></i></a>
                                <a class="btn btn-xs btn-danger mb-1" href="/user/harddelete/<?= $data['user_id']; ?>" data-toggle="modal" data-target="#deleteModal<?= $data['user_id']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                                <form action="/user/harddelete/<?= $data['user_id']; ?>" method="POST">
                                    <?php csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <!-- Button trigger modal -->

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal<?= $data['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteLabel<?= $data['user_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel<?= $data['user_id']; ?>">Do you want to delete this data?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Select "Delete" below if you are sure to erase the data.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-secondary">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        <?php else : ?>
            <td colspan="8" class="text-center table-softgrey">No data shown.</td>
        <?php endif ?>
        </table>
    </div>
    <div class="row p-2">
        <div class="col-md-12 ">
            <?= $pager->links('user', 'custom_pagination') ?>
            <!-- ('nametable', 'customtemplate') -->
        </div>
    </div>
<?php elseif ($viewer == 'view') : ?>
    <!-- <div class="page-inner mt--5"> -->
    <div class="row mt--2">
        <div class="col-md-4">
            <div class="card-profile">
                <div class="card card-header bg-secondary mt--3">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img src="/assets/images/avatar/<?= $user['avatar']; ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name"><?= $user['name']; ?>, 19</div>
                        <div class="job"><?= $user['role']; ?> (<?= ($user['is_active'] == 1) ? 'Active' : 'Inactive'; ?>)</div>
                        <div class="desc"><?= $user['email']; ?></div>
                        <div class="social-media">
                            <a class="btn btn-info btn-sm btn-link" rel="publisher" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-instagram"></i> </span>
                            </a>
                            <a class="btn btn-info btn-twitter btn-sm btn-link" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                            </a>
                            <a class="btn btn-info btn-sm btn-link" rel="publisher" href="#">
                                <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card card-footer">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number">125</div>
                            <div class="title">Post</div>
                        </div>
                        <div class="col">
                            <div class="number">25K</div>
                            <div class="title">Followers</div>
                        </div>
                        <div class="col">
                            <div class="number">134</div>
                            <div class="title">Following</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class=" full-height">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-primary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="collapse" href="#today" role="button" aria-expanded="false" aria-controls="today">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week" role="tab" aria-selected="false">Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false">Month</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="collapse" id="today">
                        <p class="card-body">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt minus adipisci qui dolorum quis voluptates at odit architecto vel enim dolorem ipsa, consequuntur blanditiis aperiam aliquid perferendis temporibus! Blanditiis doloribus libero nemo corrupti maiores et consectetur dignissimos aspernatur labore hic. Ipsa nesciunt nihil enim. Rerum aut soluta quam unde nihil, quos magnam voluptatibus eaque consectetur maiores veritatis alias sunt neque harum iusto necessitatibus maxime tenetur quas, cum itaque! Possimus rerum ducimus dolores. Dolorem ut beatae eum, accusamus possimus odio reprehenderit praesentium doloribus dolores nulla asperiores eveniet, placeat sint quo! Omnis, dolores doloremque! Nam consectetur modi ab consequuntur, aspernatur illo ex a reprehenderit perferendis cumque quidem, qui architecto placeat autem. Ullam aliquid voluptates veritatis, neque iure pariatur laboriosam commodi tempore fugiat possimus tempora quam officia ipsum provident saepe quos in non! Maiores illo quidem voluptatibus tempore, quasi earum voluptatem blanditiis dicta ullam ut deserunt commodi mollitia repellat molestiae placeat asperiores possimus distinctio nam animi. Velit laudantium culpa maiores assumenda, doloribus cupiditate, ipsum porro praesentium quasi nihil vel reprehenderit dolores amet perspiciatis quia consectetur natus vero hic! Quibusdam facilis aspernatur, cumque provident cupiditate alias at numquam quod labore voluptas rerum omnis maiores, sapiente quia quis laboriosam repudiandae! Minima earum ea temporibus! Rem pariatur ipsam quos cum? Sunt architecto inventore pariatur consequuntur, est vitae illum, aliquam totam omnis minima tenetur voluptatem! Voluptatibus maxime pariatur ullam beatae assumenda qui impedit, facere dolore. Odio, voluptates dolores cumque quasi dicta ipsam officiis exercitationem amet adipisci saepe soluta, sit inventore a enim corporis dolorem, magni impedit maiores suscipit quibusdam maxime ut optio? Dignissimos ducimus quas laborum, enim, eligendi, suscipit nihil facere a maxime vero distinctio magni fugit omnis. Iste aut exercitationem sit, in veritatis tempora quos minima repellendus nostrum iure velit ipsa rerum culpa, optio sed doloribus. Similique magni iusto voluptates ratione corporis cum explicabo quos. Molestias labore voluptatibus quidem minima fugit facilis atque, dolorem dolorum voluptate ipsa, praesentium ab pariatur eligendi laboriosam vero est, ad maiores deserunt unde! Molestias tempora magni adipisci, praesentium magnam quam at, molestiae incidunt temporibus rerum suscipit id! Dolores, nam, inventore placeat voluptate perspiciatis possimus fugit sit totam quasi, corporis beatae! Praesentium soluta hic aliquam rem. Dignissimos eum sit fugit nostrum voluptas, nesciunt cupiditate facilis perspiciatis facere tempora quod modi accusantium officiis mollitia minima delectus dolores nam doloribus excepturi, nisi iste ullam aut optio. Fuga iusto, tenetur asperiores aliquam porro, soluta ipsam quis nulla ab nisi earum quos, facilis praesentium omnis. Fugiat. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->
<?php elseif ($viewer == 'reset') : ?>
    <form method="post" action="/user/resetPasswordProcess/<?= $user['user_id']; ?>" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <input type="hidden" name="segment2" value="<?= $request->uri->getSegment(2) ?>">
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Login Password</label>
            <div class="col-sm-10">
                <input value="<?= old('password'); ?>" type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Please reinput your login password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('password')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
                <input value="<?= old('newpassword'); ?>" type="password" name="newpassword" class="form-control <?= ($validation->hasError('newpassword')) ? 'is-invalid' : ''; ?>" id="newpassword" placeholder="Please input new password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('newpassword')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="repeatpassword" class="col-sm-2 col-form-label">Repeat Password</label>
            <div class="col-sm-10">
                <input value="<?= old('repeatpassword'); ?>" type="password" name="repeatpassword" class="form-control <?= ($validation->hasError('repeatpassword')) ? 'is-invalid' : ''; ?>" id="repeatpassword" placeholder="Please repeat new password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('repeatpassword')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/user" class="btn btn-warning">Cancle</a>
                <button type="submit" class="btn btn-secondary">Update</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'accountSetting') : ?>
    <h4>Reset Password</h4>
    <form method="post" action="/user/resetPasswordProcess/<?= $user['user_id']; ?>" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <input type="hidden" name="segment2" value="<?= $request->uri->getSegment(2) ?>">
        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Login Password</label>
            <div class="col-sm-10">
                <input value="<?= old('password'); ?>" type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" placeholder="Please reinput your login password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('password')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="newpassword" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
                <input value="<?= old('newpassword'); ?>" type="password" name="newpassword" class="form-control <?= ($validation->hasError('newpassword')) ? 'is-invalid' : ''; ?>" id="newpassword" placeholder="Please input new password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('newpassword')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="repeatpassword" class="col-sm-2 col-form-label">Repeat Password</label>
            <div class="col-sm-10">
                <input value="<?= old('repeatpassword'); ?>" type="password" name="repeatpassword" class="form-control <?= ($validation->hasError('repeatpassword')) ? 'is-invalid' : ''; ?>" id="repeatpassword" placeholder="Please repeat new password">
                <div class="invalid-feedback">
                    <?= ($validation->getError('repeatpassword')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <button type="submit" class="btn btn-xs btn-secondary">Save</button>
            </div>
        </div>
    </form>
    <div class="separator-solid"></div>
    <h4>Website Color Theme</h4>
    <form method="post" action="/user/colorthemes/<?= $user['user_id']; ?>" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="logo" class="col-sm-2 col-form-label">Logobar Color</label>
            <div class="col-sm-10">
                <div class="row gutters-xs">
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="dark" class="colorinput-input" <?= (get_cookie('logo') == 'dark') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-black"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="blue" class="colorinput-input" <?= (get_cookie('logo') == 'blue') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="purple" class="colorinput-input" <?= (get_cookie('logo') == 'purple') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-secondary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="light-blue" class="colorinput-input" <?= (get_cookie('logo') == 'light-blue') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-info"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="green" class="colorinput-input" <?= (get_cookie('logo') == 'green') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-success"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="red" class="colorinput-input" <?= (get_cookie('logo') == 'red') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-danger"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="orange" class="colorinput-input" <?= (get_cookie('logo') == 'orange') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-warning"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="logo" type="radio" value="white" class="colorinput-input" <?= (get_cookie('logo') == 'white') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-grey1"></span>
                        </label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('color')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="navbar" class="col-sm-2 col-form-label">Navbar Color</label>
            <div class="col-sm-10">
                <div class="row gutters-xs">
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="dark" class="colorinput-input" <?= (get_cookie('navbar') == 'dark') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-black"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="blue" class="colorinput-input" <?= (get_cookie('navbar') == 'blue') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="purple" class="colorinput-input" <?= (get_cookie('navbar') == 'purple') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-secondary"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="light-blue" class="colorinput-input" <?= (get_cookie('navbar') == 'light-blue') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-info"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="green" class="colorinput-input" <?= (get_cookie('navbar') == 'green') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-success"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="red" class="colorinput-input" <?= (get_cookie('navbar') == 'red') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-danger"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="orange" class="colorinput-input" <?= (get_cookie('navbar') == 'orange') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-warning"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="navbar" type="radio" value="white" class="colorinput-input" <?= (get_cookie('navbar') == 'white') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-grey1"></span>
                        </label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('color')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="sidebar" class="col-sm-2 col-form-label">Sidebar Color</label>
            <div class="col-sm-10">
                <div class="row gutters-xs">
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="sidebar" type="radio" value="dark" class="colorinput-input" <?= (get_cookie('sidebar') == 'dark') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-black"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="sidebar" type="radio" value="white" class="colorinput-input" <?= (get_cookie('sidebar') == 'white') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-grey1"></span>
                        </label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('color')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="background" class="col-sm-2 col-form-label">Background Color</label>
            <div class="col-sm-10">
                <div class="row gutters-xs">
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="background" type="radio" value="dark" class="colorinput-input" <?= (get_cookie('background') == 'dark') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-black"></span>
                        </label>
                    </div>
                    <div class="col-auto">
                        <label class="colorinput">
                            <input name="background" type="radio" value="white" class="colorinput-input" <?= (get_cookie('background') == 'white') ? 'checked' : ''; ?>>
                            <span class="colorinput-color bg-grey1"></span>
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
                <button type="submit" class="btn btn-xs btn-secondary">Save</button>
            </div>
        </div>
    </form>
<?php endif; ?>

<div id="loader"></div>

<?= $this->endSection() ?>