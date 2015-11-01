/*import React, { Component } from 'react';
import { render } from 'react-dom'
import { Router, Route, Link } from 'react-router'

class App extends Component {
    render() {
        return (
            <div>Hello React</div>
        )
    }
})

class About extends Component {
    render() {
        return (
            <div>About Muzik</div>
        )
    }
})

render((
    <Router>
        <Route path="/" component={App}>
            <Route path="about" component={About}/>
            // <Route path="*" component={NoMatch}/>
        </Route>
    </Router>
), document.getElementById('app'))