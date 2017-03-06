import React from 'react';
import { Route, IndexRoute } from 'react-router';
import PunditList from './components/punditList';
import EditPundit from './components/editPundit';
import AddPundit from './components/addPundit';

export default (
  <Route path="/">
	  <IndexRoute component={PunditList} />
	  <Route path="edit/:id" component={EditPundit} />
	  <Route path="add" component={AddPundit} />
  </Route>
);