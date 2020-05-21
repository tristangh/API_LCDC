import React from 'react';
import './App.css';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Redirect
} from "react-router-dom";
import AddPage from './pages/AddPage';
import SearchPage from './pages/SearchPage'

export default function App() {
  return (
    <Router>
      <div>
        <Switch>
          <Route path="/add">
            <AddPage/>
          </Route>
          <Route path="/search">
            <SearchPage/>
          </Route>
          <Route exact path="/">
            <Redirect from="/" to="/add"/>
          </Route>
        </Switch>
      </div>
    </Router>
  );
}