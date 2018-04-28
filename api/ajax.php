<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ge
 * Date: 18-4-28
 * Time: 上午11:04
 * To change this template use File | Settings | File Templates.
 */

include '../init.php';
include 'login.class.php';
include 'common.class.php';
$ac = htmlspecialchars($_GET['ac'],ENT_QUOTES);
switch($ac){
    case 'getopenid':
        $code = $_GET['code'];
        $controller = new Login();
        $controller->getOpenid($code);
        break;
}
