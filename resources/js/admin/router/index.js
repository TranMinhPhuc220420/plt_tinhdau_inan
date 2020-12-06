import React from 'react';
import { Switch, Route } from 'react-router-dom';

//pages
import Home from '../page/home';
import EssentialOilTypeProduct from '../page/essentialOil/typeProduct';
import EssentialOilCategoryProduct from '../page/essentialOil/categoryProduct';

const AppRouter = (props) => {
    return (
        <Switch>
            <Route path="/admin/home" component={Home} extra />
            <Route path="/admin/essential-oil/category-product" component={EssentialOilCategoryProduct} extra />
            <Route path="/admin/essential-oil/type-product" component={EssentialOilTypeProduct} extra />
        </Switch>
    );
}
export default AppRouter;
