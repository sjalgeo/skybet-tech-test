import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { fetchPundits } from '../actions/punditActions';

class PunditList extends Component {

	static contextTypes = {
		router: PropTypes.object
	};

	constructor() {
		super();
		this.renderRow = this.renderRow.bind(this);
	}

	componentWillMount() {
		this.props.fetchPundits();
	}

	renderRow( pundit, key ) {
		return <tr key={key}>
			<td>
				<h3>{pundit.firstname + ' ' + pundit.surname}</h3>
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

export default connect( mapStateToProps, { fetchPundits } )( PunditList );