import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { Field, reduxForm } from 'redux-form';
import { createPundit } from '../actions/punditActions';
import { Link } from 'react-router';
import validate from './validate';
import renderField from './renderField';

class AddPunditForm extends Component {

	static contextTypes = {
		router: PropTypes.object
	};

	handleSubmit = ( values ) => {
		this.props.createPundit( values )
		  .then(() => {
			  this.context.router.push('/');
		  });
	};

	render() {

		const { handleSubmit, pristine, submitting } = this.props;

		return <div className="row">

			<h1>Add New Pundit</h1>
			<form onSubmit={handleSubmit(this.handleSubmit)}>

				<Field label="First Name" name="firstname" component={renderField} type="text"/>
				<Field label="Surname" name="surname" component={renderField} type="text"/>

				<button className="btn btn-primary" type="submit" disabled={pristine || submitting}>Add New Pundit</button>
			</form>

			<Link className="btn btn-outline-info" to="/">Back to Pundits</Link>
		</div>
	}
}

let addPunditForm = reduxForm({
	form: 'AddPunditForm',
	validate
})(AddPunditForm);

export default connect( null, { createPundit } )( addPunditForm );