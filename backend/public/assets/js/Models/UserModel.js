export default class UserModel {
    _id;
    _controllerName = 'usr';

    constructor(id) {
        this._id = id;
    }

    async getBalanceMonths() {
        let response = await fetch('/?controller=' + encodeURIComponent(this._controllerName) +
                                          '&action=user-bm&user_id=' + encodeURIComponent(this._id) );
        response = await response.json();
        if ('success' !== response.result_status) {
            let errMsgPrefix = 'Can\'t load user balances';
            console.error(`${errMsgPrefix}. Error details:`, response.errors);
            alert(`${errMsgPrefix}. More details see in console`)
            return [];
        }

        return response.data;
    }
}
