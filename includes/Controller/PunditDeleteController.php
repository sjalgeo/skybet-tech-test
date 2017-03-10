<?php

namespace SkyBetTechTest\Controller;

class PunditDeleteController extends JSONController {

	public function run() {

		if ( ! isset($_POST['id'] ) ) {

			$this->response = array(
				'status'    => 'error',
				'code'      => 'missing-parameter',
				'message'   => 'No pundit ID was provided.'
			);

			return;
		}

		$id = intval( $_POST['id'] );
		$this->db->delete( 'pundits', $id );

		$error = $this->db->get_last_error();

		if ( $error ) {
			$this->response = array(
				'status'    => 'failed',
				'code'      => $error
			);
		} else {
			$this->response = array(
				'status'    => 'success',
				'command'   => 'delete'
			);
		}
	}
}