<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Records extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('records_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		// Pagination configuration
		$data['module'] = 'records';
		$data['title'] = 'Home';
		$data['uptitle'] = "Home";
		render_site('index', $data);
	}


}