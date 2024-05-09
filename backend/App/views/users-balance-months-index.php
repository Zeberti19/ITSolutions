<?php
/**@var array $users*/
/**@var array $userDefaultBalanceData*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chesnokov Evgenii. Test task. Create page to display user balances per months">
    <title>Chesnokov Evgenii. Test task</title>
    <link href="/assets/css/_common.css" rel="stylesheet">
    <link href="/assets/css/pages/users-balance-months.css" rel="stylesheet">
    <script src="/assets/js/Models/UserModel.js"></script>
    <script src="/assets/js/Views/UsersBalanceMonthsView.js"></script>
    <script src="/assets/js/Controllers/UsersBalanceMonthsController.js"></script>
</head>
<body class="prj-page users-balance-months">
    <header class="prj-page__header">
        <h1 class="header">
            <span>Chesnokov Evgenii. Test task</span>
        </h1>
    </header>
    <main class="prj-page__content">
        <section>
            <header class="users-balance-months__header_user-select">
                <h2 class="header">Users month balances</h2>
            </header>
            <label class="label" for="user-select">Select user</label>
            <select id="user-select"
                    onchange="(() => { pageController.userSelectChanged(this) })()"
                    class="users-balance-months__user-select select"
            >
                <?php foreach ($users as $userId => $userName): ?>
                    <option class="select__option"
                            value="<?= htmlspecialchars($userId) ?>" >
                        <?= htmlspecialchars( $userName ); ?>
                    </option>
                <?php endforeach ?>
            </select>
            <table id="user-balance-data">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>Balances</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($userDefaultBalanceData as $balanceData): ?>
                    <tr>
                        <td><?= htmlspecialchars($balanceData['trdate']) ?></td>
                        <td><?= htmlspecialchars($balanceData['balance']) ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer class="prj-page__footer"></footer>
</body>
</html>