import React from 'react';
import { Route, IndexRoute } from 'react-router';
import PunditList from './components/punditList';

export default (
  <Route path="/">
	  <IndexRoute component={PunditList} />
  </Route>
);