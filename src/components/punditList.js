import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { fetchPundits, selectPundit, updatePundit } from '../actions/punditActions';

class PunditList extends Component {

	static contextTypes = {
		router: PropTypes.object
	};

	constructor() {
		super();
		this.renderRow = this.renderRow.bind(this);
		this.editPundit = this.editPundit.bind(this);
	}

	componentWillMount() {
		this.props.fetchPundits();
	}

	editPundit( id ) {
		this.props.selectPundit(id);
		this.context.router.push('edit/' + id );
	}

	renderRow( pundit, key ) {
		return <tr key={key}>
			<td>
				<h3>{pundit.firstname + ' ' + pundit.surname}</h3>
			</td>
			<td>
				<button className="btn btn-warning pull-right"
						onClick={this.editPundit.bind(null, pundit.id)}>Edit</button>
			</td>
		</tr>
	};

	renderPundits() {
		return this.props.pundits.map( this.renderRow )
	}

	render() {
		return <div>
			<table className="table table-responsive">
				<thead className="thead-default">
				<tr>
					<th><h2>Name</h2></th>
					<th><h2 className="pull-right">Actions</h2></th>
				</tr>
				</thead>
				<tbody>
				{this.renderPundits()}
				</tbody>
			</table>
		</div>
	}
}

const mapStateToProps = (state) => {
	const { all } = state.pundits;
	return { pundits: all };
};

export default connect( mapStateToProps, { fetchPundits, selectPundit } )( PunditList );