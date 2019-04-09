import React from 'react';
import ReactDOM from 'react-dom';
import { Router } from '@reach/router';
import { baseUrl } from './core/variables';

function App() {
  return (
    <div>
      <h1>Sekoliko</h1>
      <Link to="/">Home</Link> | <Link to="/dashboard">Dashboard</Link>
      <Router basepath={baseUrl}>
        <Home path="/" />
        <Dash path="/dashboard" />
      </Router>
    </div>
  );
}

ReactDOM.render(<App />, document.getElementById('root'));
