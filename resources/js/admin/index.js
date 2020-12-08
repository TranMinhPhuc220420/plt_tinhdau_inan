import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from "react-router-dom";

// components
import AppRouter from './router';
import Navigation from './components/navigation'
import Footer from './components/footer'

const AppAdmin = () => {
  return (
    <Router>
      <Navigation />
      <AppRouter />
      <Footer />

      <div id="sidebar-overlay"></div>
    </Router>
  );
};

if (document.getElementById('wrapper')) {
  ReactDOM.render(<AppAdmin />, document.getElementById('wrapper'));
}
