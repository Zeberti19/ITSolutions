<?php

namespace App\Models;
use App\_Common\DB;

class UserModel
{
    public function __construct(protected int $id) {
        //
    }

    public static function getAllWithTransactions(): array
    {
        $dataDB = DB::connect()->query(
           <<<SQL
           select distinct u.id, u.name
           from users u
                inner join user_accounts ua on ua.user_id = u.id
           where ua.id in (select account_from as account
                           from transactions
                           union
                           select account_to as account
                           from transactions)
           SQL);

        $dataProcessed = [];
        foreach ($dataDB as $row) {
            $dataProcessed[$row['id']] = $row['name'];
        }
        return $dataProcessed;
    }

    public function getBalanceMonths(): array
    {
        $statement = DB::connect()->prepare(
            <<<SQL
            select trdate,
                   sum(balance_changing) as balance
            from (
                     select ua_from.user_id as user_from_id,
                            ua_to.user_id as user_to_id,
                            -t.amount as balance_changing,
                            date_format(t.trdate, '%Y-%m') as trdate
                     from transactions t
                          inner join user_accounts ua_from on t.account_from = ua_from.id
                          inner join user_accounts ua_to on t.account_to = ua_to.id
                     where ua_from.user_id = :user_from_id and
                           ua_from.user_id != ua_to.id
                     union all
                     select ua_to.user_id as user_from_id,
                            ua_from.user_id as user_to_id,
                            t.amount as balance_changing,
                            date_format(t.trdate, '%Y-%m') as trdate
                     from transactions t
                          inner join user_accounts ua_from on t.account_from = ua_from.id
                          inner join user_accounts ua_to on t.account_to = ua_to.id
                     where ua_to.user_id = :user_from_id and
                           ua_from.user_id != ua_to.id
                 ) data_main
            group by trdate
            order by trdate
            SQL);
        $statement->execute([':user_from_id' => $this->id]);
        return $statement->fetchAll();
    }
}