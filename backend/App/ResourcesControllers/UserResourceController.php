<?php

namespace App\ResourcesControllers;

require_once "../App/Models/UserModel.php";

use App\Models\UserModel;
use Exception;

class UserResourceController
{
    public function userBalanceByMonths(): void
    {
        $errMsgPfx = "User. Balance by months retrieving. ";
        $response = [
            "result_status" => null
        ];
        try {
            $userId = (string)($_REQUEST['user_id'] ?? '');
            if (empty($userId)) throw new Exception("User ID in input data is empty");

            $userBalance = (new UserModel($userId))->getBalanceMonths();

            $response["result_status"] = "success";
            $response["data"] = $userBalance;

            $responseJson = json_encode($response);
            if (!$responseJson) throw new Exception("Can't convert result data to json");

            echo $responseJson;
        }
        catch (\Throwable $exc) {
            $response["result_status"] = "fail";
            $response["errors"] = "{$errMsgPfx}{$exc->getMessage()}";
            $responseJson = json_encode($response);

            http_response_code(500);

            if (!$responseJson) echo "{$errMsgPfx}{$exc->getMessage()}";
            else echo $responseJson;
        }
    }
}