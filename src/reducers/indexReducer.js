import { combineReducers } from 'redux';
import punditsReducer from './punditReducer';

const rootReducer = combineReducers({
	pundits: punditsReducer
});

export default rootReducer;