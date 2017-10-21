require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory , IndexRoute} from 'react-router';

import Master from './components/master';
import Home from './components/home';
import Admin from './components/admin';


const app = document.getElementById('app');
const apidomain = 'http://miniquiz.app';

render(
    <Router history={browserHistory} >
        <Route path="/" component={Master}  >
            <IndexRoute component={Home} apidomain={apidomain} />
            <Route path="/admin" component={Admin} />
        </Route>
    </Router>,
app);