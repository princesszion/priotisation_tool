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
		dd($this->session->userdata());
		if ($this->session->userdata('is_admin')) {
			redirect(base_url('dashboard'));
		} else {
			redirect(base_url('auth/login'));
		}

		$this->load->view('plain', $data);
	}


	public function frontend($data)
	{
		//check_logged_in();
		$this->load->view('site', $data);
	}

	public function dashboards($data)
	{
		//check_logged_in();
		$this->load->view('dashboards', $data);
	}
}
