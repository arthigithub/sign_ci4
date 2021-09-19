<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url('assets/css/style.css') ?>" />
    <script src="main.js"></script>
</head>
<body>

<section>
    <div class="container">
        <div class="row log">
            <div class="col-md-5 offset-3">
                <h4 class="text-center"><?= $title; ?></h4>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td><?= ucfirst($userinfo['name']); ?></td>
                        <td><?= $userinfo['email']; ?></td>
                        <td><a href="<?= site_url('auth/logout') ?>">Log Out</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>

</body>
</html>