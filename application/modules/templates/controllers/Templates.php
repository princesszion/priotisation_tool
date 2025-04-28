<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Templates extends MX_Controller
{


	public function main($data)
	{

		//  check_admin_access();
		
		if ($this->session->userdata('is_admin')) {
			$this->load->view('main', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function plain($data)
	{
		//dd($this->session->userdata());
		if ($this->session->userdata('is_admin')) {
			redirect(base_url('dashboard'));
		} else {
			redirect(base_url('auth'));
		}

		$this->load->view('plain', $data);
	}


	public function frontend($data)
	{
		//check_logged_in();
		if(!empty($this->session->userdata('id'))) {	
		$this->load->view('site', $data);
		}
		else{
		redirect('auth');
		}
	}

	public function dashboards($data)
	{
		//check_logged_in();
		$this->load->view('dashboards', $data);
	}
}
