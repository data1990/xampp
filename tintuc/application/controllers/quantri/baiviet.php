<?php 
class Baiviet extends My_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('baiviet_model');
	}
	function thembaiviet()
	{
		$this->load->model('danhmuc_model');
		$listcm = $this->danhmuc_model->get_list();
		$data =array();
		$data['temp'] = 'quantri/baiviet/thembai';
		$data['listcm'] = $listcm;
		if($this->input->post())
		{
			$this->form_validation->set_rules('tieude', 'Tiêu đề', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('noidung', 'Nội dung bài viết', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('chuyenmuc', 'Chuyên mục', 'trim|required');
			$datestring = '%d/%m/%Y';//'Year: %Y Month: %m Day: %d - %h:%i %a'; '%d/%m/%Y';
			$time = time();
			$ngay= mdate($datestring, $time);
			if($this->form_validation->run()) {
				$tieude = $this->input->post('tieude');
				$noidung = $this->input->post('noidung');
				$idcm = $this->input->post('chuyenmuc');
				$slug = strtolower(url_title(convert_accented_characters($tieude)).'.html');

				$input = array('tieude' => $tieude, 'noidung' =>$noidung,'idcm' => $idcm,'slug' =>$slug,'ngay'=>$ngay);
				$this->baiviet_model->create($input);
				$this->session->set_flashdata('thongbao', 'Đã thêm thành công');
			}
		}
		$this->load->view('quantri/index',$data);
	}
	function xembaiviet()
	{
		$data = array();
		$data['temp'] ='quantri/baiviet/xembaiviet';
		$list = $this->baiviet_model->get_list();
		$data['list'] = $list;
		$this->load->view('quantri/index',$data);
	}
	function suabaiviet()
	{
		$data = array();
		$this->load->model('danhmuc_model');
		$listcm = $this->danhmuc_model->get_list();
		$data['listcm'] = $listcm;
		$idbv = $this->uri->segment(4);
		$row = $this->baiviet_model->get_info($idbv);
		if($this->input->post())
		{
			$this->form_validation->set_rules('tieude', 'Tiêu đề', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('noidung', 'Nội dung bài viết', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('chuyenmuc', 'Chuyên mục', 'trim|required');
			if($this->form_validation->run()) {
				$tieude = $this->input->post('tieude');
				$noidung = $this->input->post('noidung');
				$idcm = $this->input->post('chuyenmuc');
				$slug = strtolower(url_title(convert_accented_characters($tieude)).'.html');
				$datestring = '%d/%m/%Y';//'Year: %Y Month: %m Day: %d - %h:%i %a'; '%d/%m/%Y';
				$time = time();
				$ngay= mdate($datestring, $time);
				$input = array('tieude' => $tieude, 'noidung' =>$noidung,'idcm' =>$idcm,'slug' =>$slug,'ngay'=>$ngay);
				$this->baiviet_model->update($idbv,$input);
				$this->session->set_flashdata('thongbao', 'Đã sửa thành công');
				$row->tieude = $tieude;
				$row->noidung = $noidung;
				$row->idcm= $idcm;
			}
		}
		$data['row'] = $row;
		$data['temp'] ='quantri/baiviet/suabaiviet';
		$this->load->view('quantri/index',$data);	
	}
	function xoabaiviet()
	{
		$id = $this->uri->segment(4);
		$this->baiviet_model->delete($id);
		$this->session->flashdata('thongbao','Xoá thành công !');
		redirect(quantri_url('baiviet/xembaiviet'));
	}
}
?>