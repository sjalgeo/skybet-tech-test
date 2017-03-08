<?php

namespace SkyBetTechTest\Controller;

class PunditResetController extends JSONController {

	/**
	 * Resets the database to its initial values.
	 */
	public function run() {
		$this->db->reset();

		$this->response = array(
			'status'    => 'success'
		);
	}

}