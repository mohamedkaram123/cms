import React from 'react'

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import { Urls } from '../urls';
import Firebase from './firebase';
export default function RouterFirebase() {
    return (
        <div>
        <Router>
          <Switch>
        {/* <Route path={Urls.static_url + "/NewerOrders/new_order"} >
          <NewOrder sellers={$("#orders").data("sellers") } />
        </Route> */}

        <Route path="/">
          <Firebase  />
        </Route>
      </Switch>

  </Router>
      </div>
    )
}
