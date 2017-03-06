import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { createStore, applyMiddleware } from 'redux';
import routes from './routes';
import promise from 'redux-promise';
import reducers from './reducers/indexReducer';
import { Router, browserHistory, hashHistory } from 'react-router';

const createStoreWithMiddleware = applyMiddleware(
  promise
)(createStore);

const app = <Provider store={createStoreWithMiddleware(reducers)}>
  <Router history={browserHistory} routes={routes} />
  </Provider>;

ReactDOM.render( app, document.getElementById('root') );