export default class UsersBalanceMonthsView {

    balanceMonthsTableId = 'user-balance-data';

    constructor() {}

    drawBalanceMonthsTable(userBalanceData){
        let tr, td, tbodyChildren = [],
            tbody = document.querySelector(`#${this.balanceMonthsTableId} > tbody`);

        for (let n = 0; n < userBalanceData.length; n++) {
            tr = document.createElement('tr');

            td = document.createElement('td');
            td.textContent = userBalanceData[n].trdate;
            tr.appendChild(td);

            td = document.createElement('td');
            td.textContent = userBalanceData[n].balance;
            tr.appendChild(td);

            tbodyChildren.push(tr)
        }
        tbody.replaceChildren(...tbodyChildren);
    }
}
