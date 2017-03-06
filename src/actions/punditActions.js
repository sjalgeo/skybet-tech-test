import axios from 'axios';

export const FETCH_PUNDITS = 'FETCH_PUNDITS';

export const fetchPundits = () => {

	const ROOT_URL = 'http://localhost:8080/api.php/list';
	const request = axios.get( ROOT_URL );

	return {
		type: FETCH_PUNDITS,
		payload: request
	};
};

export const SELECT_PUNDIT = 'SELECT_PUNDIT';

export const selectPundit = ( id ) => {
	return {
		type: SELECT_PUNDIT,
		payload: id
	};
};

export const UPDATE_PUNDIT = 'UPDATE_PUNDIT';

export const updatePundit = ( data ) => {

	let form = new FormData();
	form.append('id', data.id);
	form.append('firstname', data.firstname.trim());
	form.append('surname', data.surname.trim());

	const ROOT_URL = 'http://localhost:8080/api.php/update';
	const request = axios.post( ROOT_URL, form );

	return {
		type: UPDATE_PUNDIT,
		payload: request
	};
};