<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MX_Controller
{


	public  function __construct()
	{
		parent::__construct();

		$this->module = "account";
		$this->title  = "Account";
		$this->load->model('account_model','accountmodel');
		$this->load->model('auth/auth_mdl');
	}


	public function index()
	{
		$data['module'] = "auth";
		$data['view'] = "profile";
		$data['title'] = "My Profile";

		render_site("users/profile", $data);

	}

  
	public function logout()
	{
	  session_unset();
	  session_destroy();
	  redirect( base_url());
	}
	
}
