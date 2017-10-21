import React, {Component} from 'react';
import { IndexLink, Link } from "react-router";

class Navigation extends Component {

    constructor(props){
        super(props);
        this.state = {productName: '', productPrice: ''};

        this.homeLink = this.homeLink.bind(this);
        this.adminLink = this.adminLink.bind(this);
    }

    homeLink(e) {
        // alert( location.href );
    }

    adminLink(e) {
        // alert( location.href );
    }

    render(){

        const { location } = this.props;
        const homeClass = location.pathname === '/' ? "active" : "";
        const adminClass = location.pathname.match(/^\/admin/) ? "active" : "";

        return (
            <ul className="nav navbar-nav">

                <li className={homeClass}>
                    <IndexLink to="/" onClick={this.homeLink}>Home</IndexLink>
                </li>
                <li className={adminClass}>
                    <Link to="admin" onClick={this.adminLink}>Admin</Link>
                </li>
            </ul>
        )
    }
}
export default Navigation;