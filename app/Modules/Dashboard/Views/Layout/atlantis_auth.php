<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?= $title; ?> | <?= $AppConf['SiteName']; ?></title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/layouts/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/layouts/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['/assets/layouts/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/layouts/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/layouts/atlantis/css/atlantis.css">
</head>
<?php if ($viewer == '') : ?>

    <body class="login">
        <div class="wrapper wrapper-login wrapper-login-full p-0">

            <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-primary-gradient">
                <h1 class="title fw-bold text-white mb-3">Join Our Comunity</h1>
                <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>
            </div>

            <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
                <div class="container container-login container-transparent animated fadeIn">
                    <h3 class="text-center">Sign In To Dashboard</h3>

                    <!-- flash data -->
                    <?php if (session()->getFlashdata('yeah')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('yeah') ?>
                            <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php elseif (session()->getFlashdata('boo')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('boo') ?>
                            <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <form class="form-signin" method="POST" action="loging">
                        <?php csrf_field(); ?>
                        <div class="login-form">
                            <div class="form-group">
                                <label for="account" class="placeholder"><b>Username</b></label>
                                <input value="<?= old('account'); ?>" id="account" name="account" type="text" class="form-control <?= ($validation->hasError('account')) ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= ($validation->getError('account')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="placeholder"><b>Password</b></label>
                                <?php if ($AppConf['isForgotPassword'] == 'TRUE') : ?>
                                    <a href="/auth/forgotpassword" class="link float-right">Forget Password ?</a>
                                <?php endif; ?>
                                <div class="position-relative">
                                    <input value="<?= old('password'); ?>" id="password" name="password" type="password" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
                                    <div class="show-password">
                                        <i class="icon-eye"></i>
                                    </div>
                                    <div class="invalid-feedback pb-7">
                                        <?= ($validation->getError('password')); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-action-d-flex mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="rememberme">
                                    <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold">Sign In</button>
                            </div>
                            <?php if ($AppConf['isSignUp'] == 'TRUE') : ?>
                                <div class="login-account">
                                    <span class="msg">Don't have an account yet ?</span>
                                    <a href="/auth/registration" class="link">Sign Up</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php elseif ($viewer == 'registration') : ?>

        <body class="login">
            <div class="wrapper wrapper-login wrapper-login-full p-0">

                <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-primary-gradient">
                    <h1 class="title fw-bold text-white mb-3">Join Our Comunity</h1>
                    <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>
                </div>

                <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
                    <div class="container container-login container-transparent animated fadeIn">
                        <h3 class="text-center">Sign Up</h3>

                        <!-- flash data -->
                        <?php if (session()->getFlashdata('yeah')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('yeah') ?>
                                <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php elseif (session()->getFlashdata('boo')) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('boo') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <form class="user" method="POST" action="">
                            <?php csrf_field(); ?>
                            <div class="login-form">
                                <div class="form-group">
                                    <label for="fullname" class="placeholder"><b>Fullname</b></label>
                                    <input value="<?= old('name'); ?>" id="fullname" name="name" type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->getError('name')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="placeholder"><b>Username</b></label>
                                    <input value="<?= old('username'); ?>" id="username" name="username" type="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->getError('username')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="placeholder"><b>Email</b></label>
                                    <input value="<?= old('email'); ?>" id="email" name="email" type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>">
                                    <div class="invalid-feedback">
                                        <?= ($validation->getError('email')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="placeholder"><b>Password</b></label>
                                    <div class="position-relative">
                                        <input value="<?= old('password'); ?>" id="password" name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
                                        <div class="show-password">
                                            <i class="icon-eye"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= ($validation->getError('password')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="repeat" class="placeholder"><b>Confirm Password</b></label>
                                    <div class="position-relative">
                                        <input value="<?= old('repeat'); ?>" id="repeat" name="repeat" type="password" class="form-control <?= ($validation->hasError('repeat')) ? 'is-invalid' : ''; ?>">
                                        <div class="show-password">
                                            <i class="icon-eye"></i>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= ($validation->getError('repeat')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-sub m-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input <?= ($validation->hasError('agree')) ? 'is-invalid' : ''; ?>" name="agree" id="agree" aria-describedby="invalidCheckFeedback">
                                        <label class="custom-control-label <?= ($validation->hasError('agree')) ? 'text-danger' : ''; ?>" for="agree">I <a class="text-primary" data-toggle="modal" data-target="#exampleModal">Agree</a> the Terms and Conditions.</label>
                                    </div>
                                    <div class="invalid-feedback">
                                        <?= ($validation->getError('agree')); ?>
                                    </div>
                                </div>
                                <div class="row form-action">
                                    <div class="col-md-6">
                                        <a href="/auth/login" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary w-100 fw-bold">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b><?= $AppConf['SiteName']; ?> terms and conditions.</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= $AppConf['termCondRegistration']; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($viewer == 'forgot') : ?>

            <body class="login">
                <div class="wrapper wrapper-login wrapper-login-full p-0">

                    <div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-primary-gradient">
                        <h1 class="title fw-bold text-white mb-3">Join Our Comunity</h1>
                        <p class="subtitle text-white op-7">Ayo bergabung dengan komunitas kami untuk masa depan yang lebih baik</p>
                    </div>

                    <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
                        <div class="container container-login container-transparent animated fadeIn">
                            <h3 class="text-center">Forgot Password</h3>

                            <!-- flash data -->
                            <?php if (session()->getFlashdata('yeah')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('yeah') ?>
                                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php elseif (session()->getFlashdata('boo')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('boo') ?>
                                    <button type=" button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                            <form class="form-signin" method="POST" action="">
                                <?php csrf_field(); ?>
                                <div class="login-form">
                                    <div class="form-group">
                                        <label for="account" class="placeholder"><b>Input your email address to reset your password.</b></label>
                                        <input value="<?= old('email'); ?>" name="email" type="text" class="form-control form-control-user <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="exampleInputEmail" placeholder="Email address.">
                                        <div class="invalid-feedback">
                                            <?= ($validation->getError('email')); ?>
                                        </div>
                                    </div>
                                    <div class="row form-action">
                                        <div class="col-md-6">
                                            <a href="/auth/login" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-primary w-100 fw-bold">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php elseif ($viewer == 'forbidden') : ?>

                <body class="page-not-found">
                    <div class="wrapper not-found bg-primary-gradient">
                        <h1 class="animated fadeIn">403</h1>
                        <div class="desc animated fadeIn"><span>OOPS!</span><br />Looks like you have not permission to access this page.</div>
                        <a onclick="history.back()" class="btn btn-primary btn-back-home mt-4 animated fadeInUp">
                            <span class="btn-label mr-2">
                                <i class="flaticon-left-arrow-4"></i>
                            </span>
                            Back To Previous Page
                        </a>
                    </div>
                <?php endif; ?>
                <script src="/assets/layouts/js/core/jquery.3.2.1.min.js"></script>
                <script src="/assets/layouts/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
                <script src="/assets/layouts/js/core/popper.min.js"></script>
                <script src="/assets/layouts/js/core/bootstrap.min.js"></script>
                <script src="/assets/layouts/atlantis/js/atlantis.min.js"></script>
                </body>

</html>