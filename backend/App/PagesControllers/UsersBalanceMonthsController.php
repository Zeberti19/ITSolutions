<?php

namespace App\PagesControllers;

require_once "../App/Models/UserModel.php";

use App\Models\UserModel;

class UsersBalanceMonthsController {

    protected string $viewsPath = "../App/views";

    public function index() : void {
        $users = UserModel::getAllWithTransactions();
        $userDefaultId = array_key_first($users);
        $userDefaultBalanceData = (new UserModel($userDefaultId))->getBalanceMonths();
        require "{$this->viewsPath}/users-balance-months-index.php";
    }
}