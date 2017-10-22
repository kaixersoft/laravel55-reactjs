
import React, {Component} from 'react';

class Admin extends Component {

    constructor(props) {
        super(props);

        this.state = {
            userinfo: [],
            transactions:[],
            newWalletEmail:'',
            deleteWalletEmail:'',
            searchWalletEmail:''
        };

        this.createWallet = this.createWallet.bind(this);
        this.updateNewWalletEmail = this.updateNewWalletEmail.bind(this);

        this.deleteWallet = this.deleteWallet.bind(this);
        this.updateDeleteWalletEmail = this.updateDeleteWalletEmail.bind(this);

        this.searchWallet = this.searchWallet.bind(this);
        this.updateSearchWalletEmail = this.updateSearchWalletEmail.bind(this);
    }


    createWallet() {

        let param = { 'email': this.state.newWalletEmail };
        let header = {
            'headers': {
                'x-auth-key': 'Zioj23D92j2kGf9D'
            }
        }
        axios.post('/admin/wallet/create', param, header ).then((response) => {

            console.log(response);

            if (response.status === 200) {

            }
        });

    }

    updateNewWalletEmail(evt) {
        this.state.newWalletEmail = evt.target.value;
    }


    deleteWallet() {

        let param = { 'email': this.state.deleteWalletEmail };
        let header = {
            'headers': {
                'x-auth-key': 'Zioj23D92j2kGf9D'
            }
        }
        axios.post('/admin/wallet/delete', param, header ).then((response) => {

            console.log(response);

            if (response.status === 200) {

            }
        });

    }

    updateDeleteWalletEmail(evt) {
        this.state.deleteWalletEmail = evt.target.value;
    }


    searchWallet() {
        this.getUserWallet();
    }

    updateSearchWalletEmail(evt) {
        this.state.searchWalletEmail = evt.target.value;
    }

    getUserWallet() {
        let email = this.state.searchWalletEmail;

        let header = {
            'headers': {
                'x-auth-key': 'Zioj23D92j2kGf9D'
            }
        }
        axios.get(`/admin/wallet/user?email=` + email, header)
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


    render() {
        return (
            <div className="container">
                <div className="row">
                    <h1>Admin Page</h1>
                        <div className="col-md-12">

                            <div className="col-md-6">
                                <div className="form-group">
                                    <div className="form-inline">
                                        <label htmlFor="deductCredit">New Wallet : </label>
                                        <div className="input-group">
                                            <span className="input-group-addon" >Email</span>
                                            <input type="text" className="form-control" id="newWalletEmail" onChange={ this.updateNewWalletEmail } />
                                        </div>
                                        <button type="button" className="btn btn-primary" onClick={ this.createWallet } id="btnCreate" >Create Wallet</button>
                                    </div>
                                </div>
                            </div>

                            <div className="col-md-6">
                                <div className="form-group">
                                    <div className="form-inline">
                                        <label htmlFor="deductCredit">Delete Wallet : </label>
                                        <div className="input-group">
                                            <span className="input-group-addon" >Email</span>
                                            <input type="text" className="form-control" id="deleteWalletEmail" onChange={ this.updateDeleteWalletEmail } />
                                        </div>
                                        <button type="button" className="btn btn-primary" onClick={ this.deleteWallet } id="btnDelete" >Delete Wallet</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>

                <div className="row">

                    <div className="form-group">
                        <div className="form-inline">
                            <label htmlFor="deductCredit">Search Wallet : </label>
                            <div className="input-group">
                                <span className="input-group-addon" >Email</span>
                                <input type="text" className="form-control" id="searchWalletEmail" placeholder="xerxis@wallet.io" onChange={ this.updateSearchWalletEmail } />
                            </div>
                            <button type="button" className="btn btn-primary" onClick={ this.searchWallet } id="btnSearch" >Search Wallet</button>
                        </div>
                    </div>

                </div>


                <div className="row">
                    <div className="col-md-8">
                        <div className="form-group">
                            <div className="form-inline">
                                <label className="control-label col-md-4" htmlFor="email">Email:</label>
                                <div className="col-md-4">
                                    <p className="form-control-static">{this.state.userinfo.email}</p>
                                </div>
                                <label className="control-label col-md-4" htmlFor="balance">Balance:</label>
                                <div className="col-md-4">
                                    <p className="form-control-static">$ {this.state.userinfo.balance}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="row">

                    <h3>Transactions:</h3>
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
        )
    }
}
export default Admin;