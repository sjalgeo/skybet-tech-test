import { FETCH_PUNDITS } from '../actions/punditActions';

const INITIAL_STATE = {
	all: []
};

export default ( state = INITIAL_STATE, action ) => {

	switch( action.type ) {
		case FETCH_PUNDITS:
			const response = action.payload.data;

			if ( 'success' === response.status ) {
				return { ...state, all: response.data };
			} else {
				return state;
			}

		default:
			return state;
	}
}