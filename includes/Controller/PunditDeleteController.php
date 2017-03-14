<?php

namespace SkyBetTechTest\Controller;

use SkyBetTechTest\FailureResponse;

class PunditDeleteController extends JSONController {

	public function run() {

		if ( ! isset( $this->postData['id'] ) ) {
			$message = 'No pundit ID was provided.';
			$this->response = new FailureResponse( 'missing-parameter', $message );
			return;
		}

		$id = intval( $this->postData['id'] );
		$this->db->delete( 'pundits', $id );

		$error = $this->db->get_last_error();

		if ( $error ) {
			$this->response = new FailureResponse( $error );
			$this->response->setCommand( 'delete' );
		} else {
			$this->response = array(
				'status'    => 'success',
				'command'   => 'delete'
			);
		}
	}
}