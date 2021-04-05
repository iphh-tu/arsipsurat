<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Output extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_output');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataOutput'] 	= $this->M_output->select_all();

		$data['page'] 		= "Output";
		$data['judul'] 		= "Data Output";
		$data['deskripsi'] 	= "Manage Data Output";
		$data['selectProgram'] = $this->M_output->select_program();
		$data['modal_tambah_output'] = show_my_modal('modals/modal_tambah_output', 'tambah-output', $data);

		$this->template->views('output/home', $data);
	}

	public function tampil() {
		$data['dataOutput'] = $this->M_output->select_all();
		$this->load->view('output/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('id_program', 'Program', 'trim|required');
		$this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'trim|required');
		$this->form_validation->set_rules('kode_output', 'Kode Output', 'trim|required');
		$this->form_validation->set_rules('nama_output', 'Nama Output', 'trim|required');
		$this->form_validation->set_rules('pagu', 'Pagu', '');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_output->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Output Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Output Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id_kegiatan 				= trim($_POST['id_output']);
		$data['dataOutput'] 	= $this->M_output->select_by_id($id_output);
		$data['selectProgram'] = $this->M_output->select_program();
		
		echo show_my_modal('modals/modal_update_output', 'update-output', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('id_program', 'Program', 'trim|required');
		$this->form_validation->set_rules('id_kegiatan', 'Kegiatan', 'trim|required');
		$this->form_validation->set_rules('kode_output', 'Kode Output', 'trim|required');
		$this->form_validation->set_rules('nama_output', 'Nama Output', 'trim|required');
		$this->form_validation->set_rules('pagu', 'Pagu', '');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_output->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Output Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Output Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_output = $_POST['id_output'];
		$result = $this->M_output->delete($id_kegiatan);
		
		if ($result > 0) {
			echo show_succ_msg('Data Output Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Output Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_output->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "Kode Output"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama Output");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->id); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Output.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Output.xlsx', NULL);
	}

	public function import() {
		$this->form_validation->set_rules('excel', 'File', 'trim|required');

		if ($_FILES['excel']['name'] == '') {
			$this->session->set_flashdata('msg', 'File harus diisi');
		} else {
			$config['upload_path'] = './assets/excel/';
			$config['allowed_types'] = 'xls|xlsx';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('excel')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data = $this->upload->data();
				
				error_reporting(E_ALL);
				date_default_timezone_set('Asia/Jakarta');

				include './assets/phpexcel/Classes/PHPExcel/IOFactory.php';

				$inputFileName = './assets/excel/' .$data['file_name'];
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

				$index = 0;
				foreach ($sheetData as $key => $value) {
					if ($key != 1) {
						$check = $this->M_output->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_output->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Output Berhasil diimport ke database'));
						redirect('kegiatan');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Output Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('output');
				}

			}
		}
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */