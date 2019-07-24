<?php 
class Danhmuc extends MY_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('danhmuc_model');
	}
	function themdm()
	{
		$data[]=array();
		$data['title'] = 'Thêm chuyên mục';
		$data['temp']='quantri/danhmuc/themdanhmuc';

		if($this->input->post())
		{
			
			//$this->form_validation->set_rules('tendm','Tên Danh Mục','required');
			$this->form_validation->set_rules('tendm', 'Tên Danh Mục', 'trim|required|min_length[5]');
			if($this->form_validation->run()) {
				$tendm = $this->input->post('tendm');
				$slug = strtolower(url_title(convert_accented_characters($tendm)).'.html');
				$input = array('tencm' => $tendm,'slug' =>$slug);
				$this->danhmuc_model->create($input);
				$this->session->set_flashdata('thongbao', 'Đã thêm thành công');
			}
		}
		$this->load->view('quantri/index',$data);
	}
	function xemchuyenmuc()
	{
		$data = array();
		$data['title'] = 'Xem chuyên mục';
		$data['temp'] ='quantri/danhmuc/xemdanhmuc';
		$list = $this->danhmuc_model->get_list();
		$data['list'] = $list;
		$this->load->view('quantri/index',$data);
	}
	function suachuyenmuc()
	{
		$data = array();
		$data['title'] = 'Sửa chuyên mục';
		$id = $this->uri->segment(3);

		$row = $this->danhmuc_model->get_info($id);
		
		if($this->input->post())
		{
			
			
			$this->form_validation->set_rules('tendm', 'Tên Danh Mục', 'trim|required|min_length[5]');
			if($this->form_validation->run()) {
				$tendm = $this->input->post('tendm');
				$slug = strtolower(url_title(convert_accented_characters($tendm)).'.html');
				$input = array('tencm' => $tendm,'slug' =>$slug);
				
				$this->danhmuc_model->update($id,$input);
				$this->session->set_flashdata('thongbao', 'Đã sửa thành công');
				$row->tencm = $tendm;
			}
		}
		$data['row'] = $row;
		$data['temp'] ='quantri/danhmuc/suadanhmuc';
		$this->load->view('quantri/index',$data);	
	}
	function xoachuyenmuc()
	{
		
		$id = $this->uri->segment(3);
		$data['title'] = 'Xoá chuyên mục';
		$this->danhmuc_model->delete($id);
		
		$this->session->flashdata('thongbao','Xoá thành công !');
		redirect(quantri_url('xemdanhmuc.html'));
	}
}
?>