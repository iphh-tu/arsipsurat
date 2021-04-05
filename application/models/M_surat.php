<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_surat extends CI_Model {
	public function select_all() {
		$this->db->select('*');
		$this->db->from('arsipsurat');

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($no_agenda) {
		$sql = "SELECT * FROM arsipsurat WHERE no_agenda = '{$no_agenda}'";

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
		$this->db->insert_batch('arsipsurat', $data);
		
		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE program SET kode_program='" .$data['kode_program'] ."', nama_program='" .$data['nama_program'] ."', pagu='" .$data['pagu'] ."' WHERE id_program='" .$data['id_program'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
	public function upload($data, $no_agenda) {
		$this->db->where("no_agenda", $no_agenda);
		$this->db->update("arsipsurat", $data);

		return $this->db->affected_rows();
	}
	public function delete($id) {
		$sql = "DELETE FROM arsipsurat WHERE no_agenda='".$id."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($no_agenda) {
		$this->db->where('no_agenda', $no_agenda);
		//$this->db->where('no_agenda is not null', null);
		$data = $this->db->get('arsipsurat');

		return $data->num_rows();
		/*$sql = "select * from arsipsurat WHERE no_agenda='".$no_agenda."' and no_agenda !=''";

		$this->db->query($sql);

		return $this->db->affected_rows();*/
	}

	public function total_rows() {
		$data = $this->db->get('arsipsurat');

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */