<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_output extends CI_Model {
	public function select_all() {
		$sql = "SELECT id_output, kode_program, kode_kegiatan, kode_output, nama_output, output.pagu from output, program, kegiatan where output.id_program = program.id_program and output.id_kegiatan = kegiatan.id_kegiatan";

		$data = $this->db->query($sql);


		return $data->result();
	}

	public function select_by_id($id_output) {
		$sql = "SELECT * FROM output WHERE id_output = '{$id_output}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_kota={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
		$sql = "INSERT INTO output VALUES('','" .$data['id_program'] ."','" .$data['id_kegiatan'] ."','" .$data['kode_output'] ."','" .$data['nama_output'] ."','" .$data['pagu'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('output', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE output SET id_program='" .$data['id_program'] ."','" .$data['id_kegiatan'] ."', kode_output = '" .$data['kode_output'] ."', nama_kegiatan='" .$data['nama_output'] ."', pagu='" .$data['pagu'] ."' WHERE id_output='" .$data['id_output'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id_output) {
		$sql = "DELETE FROM output WHERE id_output='" .$id_output ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama_output', $nama);
		$data = $this->db->get('output');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('output');

		return $data->num_rows();
	}
	public function select_program() {
		$sql = "select b.id_kegiatan, a.kode_program, b.kode_kegiatan, b.nama_kegiatan from program a, kegiatan b WHERE b.id_program = a.id_program";
		$data = $this->db->query($sql);

		return $data->result();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */