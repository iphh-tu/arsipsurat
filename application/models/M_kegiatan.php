<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kegiatan extends CI_Model {
	public function select_all() {
		$sql = "SELECT id_kegiatan, kode_program, nama_program, kode_kegiatan, nama_kegiatan, kegiatan.pagu from program, kegiatan where program.id_program = kegiatan.id_program";

		$data = $this->db->query($sql);


		return $data->result();
	}

	public function select_by_id($id_kegiatan) {
		$sql = "SELECT * FROM kegiatan WHERE id_kegiatan = '{$id_kegiatan}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_kota={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO kegiatan VALUES('','" .$data['id_program'] ."','" .$data['kode_kegiatan'] ."','" .$data['nama_kegiatan'] ."','" .$data['pagu'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('kegiatan', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE kegiatan SET id_program='" .$data['id_program'] ."', kode_kegiatan='" .$data['kode_kegiatan'] ."', nama_kegiatan='" .$data['nama_kegiatan'] ."', pagu='" .$data['pagu'] ."' WHERE id_kegiatan='" .$data['id_kegiatan'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id_kegiatan) {
		$sql = "DELETE FROM kegiatan WHERE id_kegiatan='" .$id_kegiatan ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama_kegiatan', $nama);
		$data = $this->db->get('kegiatan');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('kegiatan');

		return $data->num_rows();
	}
	public function select_program() {
		$data = $this->db->get('program');

		return $data->result();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */