<?= $this->extend('\Modules\Dashboard\Views\Layout\\' . $AppConf['template'] . '_template') ?>

<?= $this->section('content') ?>
<?php
if ($viewer == 'webbasicinfo') : ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="siteName" class="col-sm-2 col-form-label">Site Name</label>
            <div class="col-sm-10">
                <input value="<?= (old('siteName')) ? old('siteName') : $AppConf['siteName']; ?>" type="text" name="siteName" class="form-control <?= ($validation->hasError('siteName')) ? 'is-invalid' : ''; ?>" id="siteName" placeholder="Please input a site name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('siteName')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="summernote" class="col-sm-2 col-form-label">About Site</label>
            <div class="col-sm-10">
                <textarea name="aboutSite" id="summernote"><?= (old('aboutSite')) ? old('aboutSite') : $AppConf['aboutSite']; ?></textarea>
                <!-- <div id="summernote"></div> -->
                <div class="invalid-feedback">
                    <?= ($validation->getError('aboutSite')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="footerCaption" class="col-sm-2 col-form-label">Footer Caption</label>
            <div class="col-sm-10">
                <input value="<?= (old('footerCaption')) ? old('footerCaption') : $AppConf['footerCaption']; ?>" type="text" name="footerCaption" class="form-control <?= ($validation->hasError('footerCaption')) ? 'is-invalid' : ''; ?>" id="footerCaption" placeholder="Please input a footer caption">
                <div class="invalid-feedback">
                    <?= ($validation->getError('footerCaption')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Update</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'authconfiguration') : ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="isSignUp" class="col-sm-2 col-form-label">Sign Up</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" value="TRUE" id="customRadio1" name="isSignUp" class="custom-control-input" <?= (old('isSignUp') == 'TRUE' || $AppConf['isSignUp'] == 'TRUE') ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="customRadio1">Allowed</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" value="FALSE" id="customRadio2" name="isSignUp" class="custom-control-input" <?= (old('isSignUp') == 'FALSE' || $AppConf['isSignUp'] == 'FALSE') ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="customRadio2">Not Allowed</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('isSignUp')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="isForgotPassword" class="col-sm-2 col-form-label">Forgot Password</label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <div class="custom-control custom-radio">
                        <input type="radio" value="TRUE" id="customRadio3" name="isForgotPassword" class="custom-control-input" <?= (old('isForgotPassword') == 'TRUE' || $AppConf['isForgotPassword'] == 'TRUE') ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="customRadio3">Allowed</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" value="FALSE" id="customRadio4" name="isForgotPassword" class="custom-control-input" <?= (old('isForgotPassword') == 'FALSE' || $AppConf['isForgotPassword'] == 'FALSE') ? 'checked' : ''; ?>>
                        <label class="custom-control-label" for="customRadio4">Not Allowed</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('isForgotPassword')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="newRegistrationRoleId" class="col-sm-2 col-form-label">New Registration Role</label>
            <div class="col-sm-10">
                <select name="newRegistrationRoleId" class="form-control <?= ($validation->hasError('newRegistrationRoleId')) ? 'is-invalid' : ''; ?>" id="newRegistrationRoleId">
                    <option value="">Choose a role for new registration role</option>
                    <?php foreach ($getrole as $item) : ?>
                        <option value="<?= $item['role_id']; ?>" <?= ($AppConf['newRegistrationRoleId'] == $item['role_id']) ? 'selected = "selected"' : ''; ?>><?= $item['role']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= ($validation->getError('newRegistrationRoleId')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="summernote" class="col-sm-2 col-form-label">Term Condition Registration</label>
            <div class="col-sm-10">
                <textarea name="termCondRegistration" id="summernote"><?= (old('termCondRegistration')) ? old('termCondRegistration') : $AppConf['termCondRegistration']; ?></textarea>
                <div class="invalid-feedback">
                    <?= ($validation->getError('termCondRegistration')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Update</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'smtpconfiguration') : ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="mailName" class="col-sm-2 col-form-label">Mail Name</label>
            <div class="col-sm-10">
                <input value="<?= (old('mailName')) ? old('mailName') : $AppConf['mailName']; ?>" type="text" name="mailName" class="form-control <?= ($validation->hasError('mailName')) ? 'is-invalid' : ''; ?>" id="mailName" placeholder="Please input a mail name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('mailName')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="mailAlias" class="col-sm-2 col-form-label">Mail Alias</label>
            <div class="col-sm-10">
                <input value="<?= (old('mailAlias')) ? old('mailAlias') : $AppConf['mailAlias']; ?>" type="text" name="mailAlias" class="form-control <?= ($validation->hasError('mailAlias')) ? 'is-invalid' : ''; ?>" id="mailAlias" placeholder="Please input a mail name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('mailAlias')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="protocol" class="col-sm-2 col-form-label">Protocol</label>
            <div class="col-sm-10">
                <input value="<?= (old('protocol')) ? old('protocol') : $AppConf['protocol']; ?>" type="text" name="protocol" class="form-control <?= ($validation->hasError('protocol')) ? 'is-invalid' : ''; ?>" id="protocol" placeholder="Please input a protocol name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('protocol')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="SMTPHost" class="col-sm-2 col-form-label">SMTPHost</label>
            <div class="col-sm-10">
                <input value="<?= (old('SMTPHost')) ? old('SMTPHost') : $AppConf['SMTPHost']; ?>" type="text" name="SMTPHost" class="form-control <?= ($validation->hasError('SMTPHost')) ? 'is-invalid' : ''; ?>" id="SMTPHost" placeholder="Please input a SMTPHost name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('SMTPHost')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="SMTPUser" class="col-sm-2 col-form-label">SMTPUser</label>
            <div class="col-sm-10">
                <input value="<?= (old('SMTPUser')) ? old('SMTPUser') : $AppConf['SMTPUser']; ?>" type="text" name="SMTPUser" class="form-control <?= ($validation->hasError('SMTPUser')) ? 'is-invalid' : ''; ?>" id="SMTPUser" placeholder="Please input a SMTPUser name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('SMTPUser')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="SMTPPass" class="col-sm-2 col-form-label">SMTPPass</label>
            <div class="col-sm-10">
                <input value="<?= (old('SMTPPass')) ? old('SMTPPass') : $AppConf['SMTPPass']; ?>" type="password" name="SMTPPass" class="form-control <?= ($validation->hasError('SMTPPass')) ? 'is-invalid' : ''; ?>" id="SMTPPass" placeholder="Please input a SMTPPass name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('SMTPPass')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="SMTPPort" class="col-sm-2 col-form-label">SMTPPort</label>
            <div class="col-sm-10">
                <input value="<?= (old('SMTPPort')) ? old('SMTPPort') : $AppConf['SMTPPort']; ?>" type="text" name="SMTPPort" class="form-control <?= ($validation->hasError('SMTPPort')) ? 'is-invalid' : ''; ?>" id="SMTPPort" placeholder="Please input a SMTPPort name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('SMTPPort')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="SMTPCrypto" class="col-sm-2 col-form-label">SMTPCrypto</label>
            <div class="col-sm-10">
                <input value="<?= (old('SMTPCrypto')) ? old('SMTPCrypto') : $AppConf['SMTPCrypto']; ?>" type="text" name="SMTPCrypto" class="form-control <?= ($validation->hasError('SMTPCrypto')) ? 'is-invalid' : ''; ?>" id="SMTPCrypto" placeholder="Please input a SMTPCrypto name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('SMTPCrypto')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="mailType" class="col-sm-2 col-form-label">mailType</label>
            <div class="col-sm-10">
                <input value="<?= (old('mailType')) ? old('mailType') : $AppConf['mailType']; ?>" type="text" name="mailType" class="form-control <?= ($validation->hasError('mailType')) ? 'is-invalid' : ''; ?>" id="mailType" placeholder="Please input a mailType name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('mailType')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="charset" class="col-sm-2 col-form-label">charset</label>
            <div class="col-sm-10">
                <input value="<?= (old('charset')) ? old('charset') : $AppConf['charset']; ?>" type="text" name="charset" class="form-control <?= ($validation->hasError('charset')) ? 'is-invalid' : ''; ?>" id="charset" placeholder="Please input a charset name">
                <div class="invalid-feedback">
                    <?= ($validation->getError('charset')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Update</button>
            </div>
        </div>
    </form>
<?php elseif ($viewer == 'maintenanceconfiguration') : ?>
    <?php $dateTime = explode(" ", $AppConf['isMaintenance']);  ?>
    <form method="post" action="" enctype="multipart/form-data">
        <?php csrf_field(); ?>
        <div class="form-group row">
            <label for="datepicker" class="col-sm-2 col-form-label">Maintenance Time Ends</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="datepicker" name="date" value="<?= ($AppConf['isMaintenance'] != NULL) ? $dateTime[0] : ''; ?>" placeholder="Please input a date">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-check"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="datetime" name="time" value="<?= ($AppConf['isMaintenance'] != NULL) ? $dateTime[1] : ''; ?>" placeholder="Please input a time">
                                <div class=" input-group-append">
                                    <span class="input-group-text">
                                        <i class="fa fa-clock"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= ($validation->getError('siteName')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="summernote" class="col-sm-2 col-form-label">Maintenance Caption</label>
            <div class="col-sm-10">
                <textarea name="maintenanceCaption" id="summernote"><?= (old('maintenanceCaption')) ? old('maintenanceCaption') : $AppConf['maintenanceCaption']; ?></textarea>
                <div class="invalid-feedback">
                    <?= ($validation->getError('maintenanceCaption')); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-md-2">
                <a href="/" class="btn btn-sm btn-warning">Cancle</a>
                <button type="submit" class="btn btn-sm btn-secondary">Update</button>
            </div>
        </div>
    </form>
<?php endif; ?>

<div id=" loader">
</div>

<?= $this->endSection() ?>