'use strict';
class UsersBalanceMonthsController {

    _view;

    constructor() {
        this._view = new UsersBalanceMonthsView();
    }

    async _userChange(userNewId) {
        let User = new UserModel(userNewId);
        let userBalanceData = await User.getBalanceMonths();

        this._view.drawBalanceMonthsTable(userBalanceData);
    }

    userSelectChanged(select){
        this._userChange(select.value);
    }
}

window.onload = function() {
    window.pageController = new UsersBalanceMonthsController();
};