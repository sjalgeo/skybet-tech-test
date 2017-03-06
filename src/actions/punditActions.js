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