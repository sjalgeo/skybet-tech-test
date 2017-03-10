<?php

namespace SkyBetTechTest\Controller;

class PunditUpdateController extends JSONController {

	/**
	 * Update a single record in the database, based on the posted data.
	 */
	public function run() {
		$id = intval( $_POST['id'] );
		$data = array(
			'firstname' => htmlspecialchars( $_POST['firstname'] ),
			'surname'   => htmlspecialchars( $_POST['surname'] )
		);

		$this->db->update( 'pundits', $id, $data );

		$this->response = array(
			'status'    => 'success',
			'command'   => 'update'
		);
	}
}