<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_program');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['dataProgram'] 	= $this->M_program->select_all();

		$data['page'] 		= "program";
		$data['judul'] 		= "Data Program";
		$data['deskripsi'] 	= "Manage Data Program";

		$data['modal_tambah_program'] = show_my_modal('modals/modal_tambah_program', 'tambah-program', $data);

		$this->template->views('program/home', $data);
	}

	public function tampil() {
		$data['dataProgram'] = $this->M_program->select_all();
		$this->load->view('program/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('kode_program', 'Kode Program', 'trim|required');
		$this->form_validation->set_rules('nama_program', 'Nama Program', 'trim|required');
		$this->form_validation->set_rules('pagu', 'Pagu', '');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_program->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Program Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Program Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id_program 				= trim($_POST['id_program']);
		$data['dataProgram'] 	= $this->M_program->select_by_id($id_program);

		echo show_my_modal('modals/modal_update_program', 'update-program', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('kode_program', 'Kode Program', 'trim|required');
		$this->form_validation->set_rules('nama_program', 'Nama Program', 'trim|required');
		$this->form_validation->set_rules('pagu', 'Pagu', '');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_program->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Program Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Program Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$id_program = $_POST['id_program'];
		$result = $this->M_program->delete($id_program);
		
		if ($result > 0) {
			echo show_succ_msg('Data Program Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Program Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_program->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "Kode Program"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama Program");
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', "Pagu");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->kode_program); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama_program); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->pagu); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data Program.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data Program.xlsx', NULL);
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
						$check = $this->M_program->check_nama($value['B']);

						if ($check != 1) {
							$resultData[$index]['nama'] = ucwords($value['B']);
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_program->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data Program Berhasil diimport ke database'));
						redirect('program');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data Program Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('program');
				}

			}
		}
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */