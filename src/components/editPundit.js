import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { Field, reduxForm } from 'redux-form';
import { updatePundit, selectPundit, fetchPundits } from '../actions/punditActions';
import { Link } from 'react-router';
import validate from './validate';
import renderField from './renderField';

class EditPunditForm extends Component {

	static contextTypes = {
		router: PropTypes.object
	};

	componentWillMount() {
		const { id } = this.props.params;
		const updatePundit = () => {
            this.handleInitialize();
		};

        this.props.selectPundit(id);
		this.props.fetchPundits().then( updatePundit );
	}

	handleInitialize() {

		const { firstname, surname } = this.props.pundit;

		const initialData = {
			"firstname": firstname,
			"surname": surname,
		};

		this.props.initialize(initialData);
	}

	handleSubmit = ( values ) => {
		this.props.updatePundit( { ...values, id: this.props.params.id } )
		  .then(() => {
			  this.context.router.push('/');
		  });
	};

	render() {

		const { handleSubmit, pristine, submitting } = this.props;

		if ( null === this.props.pundit ) {
			return <div>Loading...</div>
		}

		return <div className="row">
			<h1>Edit Pundit Details</h1>
			<form onSubmit={handleSubmit(this.handleSubmit)}>

				<div>
					<label htmlFor="firstname">First Name</label>
					<Field name="firstname" component={renderField} type="text"/>
				</div>
				<div>
					<label htmlFor="surname">Last Name</label>
					<Field name="surname" component={renderField} type="text"/>
				</div>

				<button className="btn btn-primary" type="submit" disabled={pristine || submitting}>Update Pundit</button>
			</form>

			<Link className="btn btn-outline-info" to="/">Back to Pundits</Link>
		</div>
	}
}

let editPunditForm = reduxForm({
	form: 'EditPunditForm',
	validate
})(EditPunditForm);

const mapStateToProps = (state) => {
    const matchId = pundit => parseInt(pundit.id) === parseInt(state.pundits.selected);
    const pundit = state.pundits.all.find( matchId );
	return { pundit };
};

export default connect( mapStateToProps, { updatePundit, selectPundit, fetchPundits } )( editPunditForm );