import React, {Component} from 'react';
import { Router, Route, Link } from 'react-router';

import Navigation from './navigation';

class Master extends Component {
    render(){
        return (
            <div className="container">
                <nav className="navbar navbar-default">
                    <div className="container-fluid">
                        <div className="navbar-header">
                            <a className="navbar-brand">Wallet</a>
                        </div>
                        <Navigation location={location} />
                    </div>
                </nav>
                <div>
                    {this.props.children}
                </div>
            </div>
        )
    }
}
export default Master;