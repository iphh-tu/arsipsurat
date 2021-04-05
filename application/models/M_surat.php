<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_surat extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('program');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id_program) {
		$sql = "SELECT * FROM program WHERE id_program = '{$id_program}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_kota={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO program VALUES('','" .$data['kode_program'] ."','" .$data['nama_program'] ."','" .$data['pagu'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('program', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE program SET kode_program='" .$data['kode_program'] ."', nama_program='" .$data['nama_program'] ."', pagu='" .$data['pagu'] ."' WHERE id_program='" .$data['id_program'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM program WHERE id_program='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama_program', $nama);
		$data = $this->db->get('program');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('program');

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */