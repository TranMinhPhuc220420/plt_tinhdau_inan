import React from 'react';
import { Switch, Route } from 'react-router-dom';

//pages
import Home from '../page/home';
import EssentialOilTypeProduct from '../page/essentialOil/typeProduct';
import EssentialOilCategoryProduct from '../page/essentialOil/categoryProduct';

import EssentialOilProductPanelAdd from '../page/essentialOil/product/add';
import EssentialOilProductPanelEdit from '../page/essentialOil/product/edit';
import EssentialOilProduct from '../page/essentialOil/product';

import PrintProduct from '../page/print/product';
import PrintProductPanelAdd from '../page/print/product/add';
import PrintProductPanelEdit from '../page/print/product/edit';

import SettingComponent from '../page/setting';

const AppRouter = (props) => {
    return (
        <Switch>
            <Route path="/admin/home" component={Home} extra />
            <Route path="/admin/essential-oil/product" component={EssentialOilProduct} extra />
            <Route path="/admin/essential-oil/product-add" component={EssentialOilProductPanelAdd} extra />
            <Route path="/admin/essential-oil/product-edit" component={EssentialOilProductPanelEdit} extra />

            <Route path="/admin/essential-oil/category-product" component={EssentialOilCategoryProduct} extra />
            <Route path="/admin/essential-oil/type-product" component={EssentialOilTypeProduct} extra />

            <Route path="/admin/print-store/product" component={PrintProduct} extra />
            <Route path="/admin/print-store/product-add" component={PrintProductPanelAdd} extra />
            <Route path="/admin/print-store/product-edit" component={PrintProductPanelEdit} extra />

            <Route path="/admin/setting" component={SettingComponent} extra />
        </Switch>
    );
}
export default AppRouter;
