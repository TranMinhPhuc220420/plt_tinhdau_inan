import React from 'react';
import { Switch, Route } from 'react-router-dom';

//pages
import Home from '../page/home';
import TypeProduct from '../page/typeProduct';

const AppRouter = (props) => {
    return (
        <Switch>
            <Route path="/admin/home" component={Home} extra />
            <Route path="/admin/essential-oil/type-product" component={TypeProduct} extra />
        </Switch>
    );
}
export default AppRouter;
