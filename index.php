<?php session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('app_path', __DIR__ );
define('base_path', '/practive/online-store/');



require_once app_path . '/Core/App.php';
require_once app_path . '/Core/DB.php';
require_once app_path . '/Core/ControllerBase.php';
// require_once app_path . '/View/products/view-cart.phtml';

// ../../Pucblic/css/login.css

$app = new App();

$app -> run();

