<?php

namespace SkyBetTechTest\Controller;

use SkyBetTechTest\FailureResponse;

class PunditCreateController extends JSONController {
	/**
	 * Create an additional pundit and insert it into the database.
	 */
	public function run() {

		if ( ! isset( $this->postData['firstname'] ) OR ! isset( $this->postData['surname'] ) ) {
			$message = 'The required parameters were not provided.';
			$this->response = new FailureResponse( 'invalid-data', $message );
			return;
		}

		$data = array(
			'firstname' => htmlspecialchars( $this->postData['firstname'] ),
			'surname'   => htmlspecialchars( $this->postData['surname'] )
		);

		$this->db->create( 'pundits', $data );
		$this->response = array(
			'status'    => 'success',
			'command'   => 'create'
		);
	}
}