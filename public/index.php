<?php

use App\Core\App;

require __DIR__.'/../vendor/autoload.php';

if (!session_id()) {
    session_start();
}

//Default Session is admin
$_SESSION['user'] = 'admin';

$app = new App();