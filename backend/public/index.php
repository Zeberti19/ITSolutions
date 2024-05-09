<?php

use App\_Common\Environment;
use App\PagesControllers\UsersBalanceMonthsController;
use App\ResourcesControllers\UserResourceController;

//some common classes and simple environment loading
require_once "../App/_Common/Environment.php";
Environment::load();
require_once "../App/_Common/DB.php";

//simple router
$requestController = (string)($_REQUEST['controller'] ?? '');
$requestAction = (string)($_REQUEST['action'] ?? '');

//looking for controller
switch ($requestController) {
    case 'usr':
        require_once '../App/ResourcesControllers/UserResourceController.php';
        $controllerClass = UserResourceController::class;
        break;
    case 'usrs-bm':
    default:
        require_once '../App/PagesControllers/UsersBalanceMonthsController.php';
        $controllerClass = UsersBalanceMonthsController::class;
}

//looking for action
$action = match ($requestAction) {
    'user-bm' => "userBalanceByMonths",
    default => "index",
};

//run!
if (!method_exists($controllerClass, $action)) die("Not found");
(new $controllerClass())->{$action}();

