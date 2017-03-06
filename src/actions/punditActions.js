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

export const RESET_PUNDITS = 'RESET_PUNDITS';

export const resetPundits = () => {

	const ROOT_URL = 'http://localhost:8080/api.php/reset';
	const request = axios.post( ROOT_URL );

	return {
		type: RESET_PUNDITS,
		payload: request
	};
};

export const DELETE_PUNDIT = 'DELETE_PUNDIT';

export const deletePundit = ( id ) => {

	let form = new FormData();
	form.append('id', id);

	const ROOT_URL = 'http://localhost:8080/api.php/delete';
	const request = axios.post( ROOT_URL, form );

	return {
		type: DELETE_PUNDIT,
		payload: request
	};
};

export const CREATE_PUNDIT = 'CREATE_PUNDIT';

export const createPundit = ( data ) => {

	let form = new FormData();
	form.append('firstname', data.firstname.trim());
	form.append('surname', data.surname.trim());

	const ROOT_URL = 'http://localhost:8080/api.php/create';
	const request = axios.post( ROOT_URL, form );

	return {
		type: CREATE_PUNDIT,
		payload: request
	};
};