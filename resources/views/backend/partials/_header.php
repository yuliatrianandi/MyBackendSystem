<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$data['title']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=BASEURL?>/css/styles.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <a href="<?= BASEURL ?>/home/index" class="nav-item nav-link">Home</a>
                    <a href="<?= BASEURL ?>/product/index" class="nav-item nav-link">Product</a>
                    <a href="<?= BASEURL ?>/category/index" class="nav-item nav-link">Category</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
<div class="row justify-content-center">
    <div class="col-md-8">
        <?php \App\Core\Flasher::getFlash(); ?>
    </div>
</div>