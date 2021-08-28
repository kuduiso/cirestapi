<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {
	
	public function getMahasiswa($id = null) {
		if ($id === null) {
			return $this->db->get('mahasiswa')->result_array();
		} else {
			return $this->db->get_where('mahasiswa', ['nim' => $id])->result_array();
		}
	}

	public function deleteMahasiswa($id) {
		$this->db->delete('mahasiswa', ['nim' => $id]);
		return $this->db->affected_rows();
	}

	public function createMahasiswa($data) {
		$this->db->insert('mahasiswa', $data);
		return $this->db->affected_rows();
	}

	public function updateMahasiswa($id, $data) {
		$this->db->update('mahasiswa', $data, ['nim' => $id]);
		return $this->db->affected_rows();
	}

}
