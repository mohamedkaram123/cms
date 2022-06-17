import React from 'react'

import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link
  } from "react-router-dom";
import { Urls } from '../urls';
import AbandonedBaskets from '.';
import AbandonedBasketProfile from './abandoned_basket_profile/abandoned_basket_profile';
export default function RouterabandonedBasket() {
    return (
        <div>
            <Router>
                <Switch>
          <Route
          render={(props) => <AbandonedBasketProfile {...props} />}
           path={Urls.static_url + "abandoned/baskets/profile"} />

          <Route path="/">
            <AbandonedBaskets  />
          </Route>
                        </Switch>

    </Router>
        </div>
    )
}
