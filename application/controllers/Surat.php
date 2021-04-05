<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_surat');
	}

	public function index() {
		$data['userdata'] 	= $this->userdata;
		$data['datasurat'] 	= $this->M_surat->select_all();

		$data['page'] 		= "surat";
		$data['judul'] 		= "Arsip Surat";
		$data['deskripsi'] 	= "Manage Data surat";

		///$data['modal_tambah_surat'] = show_my_modal('modals/modal_tambah_surat', 'tambah-surat', $data);

		$this->template->views('surat/home', $data);
	}

	public function tampil() {
		$data['datasurat'] = $this->M_surat->select_all();
		$this->load->view('surat/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('kode_surat', 'Kode surat', 'trim|required');
		$this->form_validation->set_rules('nama_surat', 'Nama surat', 'trim|required');
		$this->form_validation->set_rules('pagu', 'Pagu', '');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_surat->insert($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data surat Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data surat Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$data['userdata'] 	= $this->userdata;

		$id_surat 				= trim($_POST['id_surat']);
		$data['datasurat'] 	= $this->M_surat->select_by_id($id_surat);

		echo show_my_modal('modals/modal_update_surat', 'update-surat', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('kode_surat', 'Kode surat', 'trim|required');
		$this->form_validation->set_rules('nama_surat', 'Nama surat', 'trim|required');
		$this->form_validation->set_rules('pagu', 'Pagu', '');

		$data 	= $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_surat->update($data);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data surat Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data surat Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function delete() {
		$no_agenda = $_POST['no_agenda'];
		$result = $this->M_surat->delete($no_agenda);
		
		if ($result > 0) {
			echo show_succ_msg('Data surat Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data surat Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);
    
		include_once './assets/phpexcel/Classes/PHPExcel.php';
		$objPHPExcel = new PHPExcel();

		$data = $this->M_surat->select_all();

		$objPHPExcel = new PHPExcel(); 
		$objPHPExcel->setActiveSheetIndex(0); 

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', "Kode surat"); 
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', "Nama surat");
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', "Pagu");

		$rowCount = 2;
		foreach($data as $value){
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $value->kode_surat); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama_surat); 
		    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $value->pagu); 
		    $rowCount++; 
		} 

		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
		$objWriter->save('./assets/excel/Data surat.xlsx'); 

		$this->load->helper('download');
		force_download('./assets/excel/Data surat.xlsx', NULL);
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
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true,true,true,true,true,null);
				//$sheetData = $objPHPExcel->getActiveSheet()->getCell('B7')->getValue();


				$index = 1;
				foreach ($sheetData as $key => $value) {
					
					if ($key != 1) {
						$check = $this->M_surat->check_nama($value['C']);

						if ($check != 1) {
							$resultData[$index]['tgl_agenda'] = $value['B'];
							$resultData[$index]['no_agenda'] = $value['C'];
							$resultData[$index]['asal_surat'] = $value['D'];
							$resultData[$index]['tujuan'] = $value['E'];
							$resultData[$index]['no_surat'] = $value['F'];
							$resultData[$index]['tgl_surat'] = $value['G'];
							$resultData[$index]['perihal'] = $value['H'];
							  /*$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$index, $value['tgl_agenda']);     
							  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$index, $value['no_agenda']);
							  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$index, $value['asal_surat']); 
							  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$index, $value['tujuan']);           
							  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$index, $value['no_surat']);
							  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$index, $value['tgl_surat']);
							  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$index, $value['perihal']);*/
						}
					}
					$index++;
				}

				unlink('./assets/excel/' .$data['file_name']);

				if (count($resultData) != 0) {
					$result = $this->M_surat->insert_batch($resultData);
					if ($result > 0) {
						$this->session->set_flashdata('msg', show_succ_msg('Data surat Berhasil diimport ke database'));
						redirect('surat');
					}
				} else {
					$this->session->set_flashdata('msg', show_msg('Data surat Gagal diimport ke database (Data Sudah terupdate)', 'warning', 'fa-warning'));
					redirect('surat');
				}

			}
		}
	}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */