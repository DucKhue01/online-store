<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('app_path', __DIR__ );


require_once app_path . '/Core/App.php';


$app = new App();

$app -> run();

