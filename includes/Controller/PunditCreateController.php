<?php

namespace SkyBetTechTest\Controller;

class PunditCreateController extends JSONController {
	/**
	 * Create an additional pundit and insert it into the database.
	 */
	public function run() {

		if ( ! isset( $_POST['firstname'] ) OR ! isset( $_POST['surname'] ) ) {
			$this->failure_response();
			return;
		}

		$data = array(
			'firstname' => htmlspecialchars( $_POST['firstname'] ),
			'surname'   => htmlspecialchars( $_POST['surname'] )
		);

		$this->db->create( 'pundits', $data );
		$this->response = array(
			'status'    => 'success',
		);
	}
}