<?php
use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends RestController {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mahasiswa');

		$this->methods['index_get']['limit'] = 2;
	}

	public function index_get() {
		$id = $this->get('id');
		if ($id === null) {
			$mahasiswa = $this->mahasiswa->getMahasiswa();
		} else {
			$mahasiswa = $this->mahasiswa->getMahasiswa($id);
		}
		// var_dump($mahasiswa);
		if ($mahasiswa) {
			$this->response([
				'status' => TRUE,
				'data' => $mahasiswa
			], 200);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'id not found'
			], 404);
		}
	}

	public function index_delete() {
		$id = $this->delete('nim');
		if ($id === null) {
			$this->response([
				'status' => FALSE,
				'message' => 'provide an id'
			], 400);
		} else {
			if ($this->mahasiswa->deleteMahasiswa($id) > 0) {
				$this->response([
					'status' => TRUE,
					'id' => $id,
					'message' => 'success deleted'
				], 200);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'id not found'
				], 400);
			}
		}
	}

	public function index_post() {
		$data = [
			'nim' => $this->post('nim'),
			'nama' => $this->post('nama'),
			'jenis_kelamin' => $this->post('jenis_kelamin'),
			'jurusan' => $this->post('jurusan')
		];
		
		if($this->mahasiswa->createMahasiswa($data) > 0) {
			$this->response([
				'status' => TRUE,
				'message' => 'success insert data'
			], 201);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'failed'
			], 400);
		}
	}

	public function index_put() {
		$id = $this->put('nim');
		$data = [
			'nama' => $this->put('nama'),
			'jenis_kelamin' => $this->put('jenis_kelamin'),
			'jurusan' => $this->put('jurusan')
		];

		if($this->mahasiswa->updateMahasiswa($id, $data) > 0) {
			$this->response([
				'status' => FALSE,
				'nim' => $id,
				'message' => 'success updated'
			], 200);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'failed'
			], 400);
		}
	}
}
