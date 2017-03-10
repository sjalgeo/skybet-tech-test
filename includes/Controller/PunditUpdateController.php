<?php

namespace SkyBetTechTest\Controller;

class PunditUpdateController extends JSONController {

	/**
	 * Update a single record in the database, based on the posted data.
	 */
	public function run() {

		$id = intval( $this->postData['id'] );
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