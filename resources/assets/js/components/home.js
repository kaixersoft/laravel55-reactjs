
import React, {Component} from 'react';
import axios from 'axios';

class Home extends Component {

    constructor(props) {
        super(props);

        this.state = {
            userinfo: [],
            transactions:[],
            addcredit:'',
            deductcredit:'',
            addcreditremarks:'',
            deductcreditremarks:''

        };

        this.addCredit = this.addCredit.bind(this);
        this.deductCredit = this.deductCredit.bind(this);

        this.updateAddCredit = this.updateAddCredit.bind(this);
        this.updateDeductCredit = this.updateDeductCredit.bind(this);

        this.updateAddCreditRemarks = this.updateAddCreditRemarks.bind(this);
        this.updateDeductCreditRemarks = this.updateDeductCreditRemarks.bind(this);
    }

    componentDidMount() {

        axios.get(`/user/wallet`)
            .then((response) => {
                this.setState({
                    userinfo: response.data.data,
                    transactions: response.data.data.transactions,
                    addcredit:'',
                    addcreditremarks:'',
                    deductcredit:'',
                    deductcreditremarks:''
                });
            }).catch((error) => {
                console.log(error);
            });

    }

    updateAddCredit(evt) {
        this.state.addcredit = evt.target.value;
    }

    updateAddCreditRemarks(evt) {
        this.state.addcreditremarks = evt.target.value;
    }


    updateDeductCredit(evt) {
        this.state.deductcredit = evt.target.value;
    }

    updateDeductCreditRemarks(evt) {
        this.state.deductcreditremarks = evt.target.value;
        console.log(this.state);
    }

    getUserWallet() {
        axios.get(`/user/wallet`)
            .then((response) => {
                this.setState({
                    userinfo: response.data.data,
                    transactions: response.data.data.transactions
                });
            })
            .then(this.forceUpdate())
            .catch((error) => {
            console.log(error);
        });
    }


    addCredit() {

        const _this = this;
        const addValue = _this.state.addcredit;
        const addRemarks = _this.state.addcreditremarks;

        const params = {
            amount: addValue,
            remarks: addRemarks
        }

        let uri = '/user/credit';
        axios.post(uri, params).then((response) => {
            if (response.status === 200) {
                _this.getUserWallet();
            }
        });
    }

    deductCredit() {

        const _this = this;
        const deductValue = _this.state.deductcredit;
        const deducRemarks = _this.state.deductcreditremarks;


        const params = {
            amount: deductValue,
            remarks: deducRemarks
        }

        let uri = '/user/debit';
        axios.post(uri, params).then((response) => {
            if (response.status === 200) {
                _this.getUserWallet();
            }
        });
    }

    render() {
        const self = this;


        return (
            <div className="row">
                <div className="col-md-12">
                    <h1>My Wallet</h1>
                    <div className="row">
                        <div className="col-md-12">


                                <form className="form-horizontal">
                                    <div className="form-group">
                                        <label className="control-label col-md-4" htmlFor="email">Email:</label>
                                        <div className="col-md-4">
                                            <p className="form-control-static">{this.state.userinfo.email}</p>
                                        </div>
                                    </div>
                                    <div className="form-group">
                                        <label className="control-label col-md-4" htmlFor="balance">Balance:</label>
                                        <div className="col-md-4">
                                            <p className="form-control-static">$ {this.state.userinfo.balance}</p>
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="form-inline">
                                            <div className="col-md-10">
                                                <label htmlFor="addCredit">Add Credit : </label>
                                                <div className="input-group">
                                                    <span className="input-group-addon" id="addCreditgrp">$</span>
                                                    <input type="text" className="form-control" id="addCredit" aria-describedby="addCreditgrp" onChange={ this.updateAddCredit } />
                                                    <span className="input-group-addon" id="addCreditgrpremarks">Remarks</span>
                                                    <input type="text" className="form-control" id="addCreditRemarks" aria-describedby="addCreditgrpremarks" onChange={ this.updateAddCreditRemarks } />
                                                </div>
                                                <button type="button" className="btn btn-primary" onClick={ this.addCredit } id="btnDeposit" >Deposit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="form-group">
                                        <div className="form-inline">
                                            <div className="col-md-8">
                                                <label htmlFor="deductCredit">Deduct Credit : </label>
                                                <div className="input-group">
                                                    <span className="input-group-addon" id="deductCreditgrp">$</span>
                                                    <input type="text" className="form-control" id="deductCredit" aria-describedby="deductCreditgrp" onChange={ this.updateDeductCredit } />
                                                    <span className="input-group-addon" id="deductCreditgrpremarks">Remarks</span>
                                                    <input type="text" className="form-control" id="deductCreditRemarks" aria-describedby="deductCreditgrpremarks" onChange={ this.updateDeductCreditRemarks } />
                                                </div>
                                                <button type="button" className="btn btn-primary" onClick={ this.deductCredit } id="btnWithdraw" >Withdraw</button>
                                            </div>
                                        </div>
                                    </div>



                                    <div className="form-group">
                                        <label className="control-label col-md-4" htmlFor="balance">Transactions:</label>
                                        <div className="col-md-10">

                                                <div className="table-responsive">
                                                <table className="table table-condensed ">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Currency</th>
                                                        <th scope="col">Remarks</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    {this.state.transactions.map((trans, index) => (
                                                        <tr>
                                                            <td>{ index+1 }</td>
                                                            <td>{ trans.transaction_date }</td>
                                                            <td>{ trans.transaction_code }</td>
                                                            <td>{ trans.transaction }</td>
                                                            <td>{ trans.amount }</td>
                                                            <td>{ trans.currency }</td>
                                                            <td>{ trans.remarks }</td>
                                                        </tr>
                                                    ))}

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </form>

                        </div>
                    </div>

                </div>
            </div>
        )
    }
}
export default Home;