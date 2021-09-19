<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign in Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"  href="<?= base_url('assets/css/style.css') ?>" />
    <script src="main.js"></script>
</head>
<body>

<section>
    <div class="container">
        <div class="row log">
            <div class="col-md-4 offset-md-4">
                <h3 class="sign-h3">Sign In</h3>
                <form action="<?= base_url('auth/save') ?>" method="POST" autocomplete='off'>
                <?= csrf_field() ?>
                <?php if(!empty(session()->getFlashdata('fail'))): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php endif ?>
                <?php if(!empty(session()->getFlashdata('success'))): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" value="<?= set_value('name') ?>" >
                        <span class="text-danger" ><?= isset($validation) ? display_error($validation,'name') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Enter your email" value="<?= set_value('email') ?>" >
                        <span class="text-danger" ><?= isset($validation) ? display_error($validation,'email') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Enter your password" value="<?= set_value('password') ?>" >
                        <span class="text-danger" ><?= isset($validation) ? display_error($validation,'password') : '' ?></span>
                    </div>
                    <div class="form-group">
                        <label for="">Conform Password</label>
                        <input type="text" name="cpassword" class="form-control" placeholder="Enter your confirm password" value="<?= set_value('cpassword') ?>">
                        <span class="text-danger" ><?= isset($validation) ? display_error($validation,'cpassword') : '' ?></span>
                    </div><br>
                    <button class="btn btn-primary" type="submit">SIGN UP</button>
                </form>
                <br>
                <a href="<?= site_url('auth/index') ?>">I already have account, login now</a>
            </div>
        </div>
    </div>
</section>
    
</body>
</html>