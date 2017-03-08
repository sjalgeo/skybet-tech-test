<?php

namespace SkyBetTechTest\Controller;

class PunditListController extends JSONController {

	/**
	 * List all pundits from database.
	 */
	public function run() {
		$this->db->fetchAll('pundits');
		$this->response = array(
			'status' => 'success',
			'data' => $this->db->get_last_result()
		);
	}
}