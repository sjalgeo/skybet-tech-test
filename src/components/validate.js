const validate = values => {

	const errors = {};

	if ( values.firstname && null === values.firstname.match('^[a-zA-Z-\']*$') ) {
		errors.firstname = 'First Names can only use letters or hyphens.'
	}

	if ( values.surname && null === values.surname.match('^[a-zA-Z-\']*$') ) {
		errors.surname = 'Surnames You can only use letters or hyphens.'
	}

	return errors
};

export default validate