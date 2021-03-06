<?php

namespace SkyBetTechTest\Controller;

use SkyBetTechTest\FailureResponse;

class PunditUpdateController extends JSONController {

	/**
	 * Update a single record in the database, based on the posted data.
	 */
	public function run() {

		if ( isset( $this->postData['id'] ) ) {
			$id = intval( $this->postData['id'] );
		} else {
			$message = 'The required parameters were not provided.';
			$this->response = new FailureResponse( 'invalid-data', $message );
			return;
		}

		$data = array(
			'firstname' => htmlspecialchars( $this->postData['firstname'] ),
			'surname'   => htmlspecialchars( $this->postData['surname'] )
		);

		$this->db->update( 'pundits', $id, $data );

		$this->response = array(
			'status'    => 'success',
			'command'   => 'update'
		);
	}
}