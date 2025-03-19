<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MX_Controller
{


	public  function __construct()
	{
		parent::__construct();

		$this->dashmodule = "dashboard";
		$this->load->model("dashboard_mdl", 'dash_mdl');
	}

	public function home()
	{
		$data['module'] = $this->dashmodule;
		$data['title'] = 'Dashboard';
		$data['uptitle'] = "Dashboard";

		//dd($data);
		render('home', $data);

}
}
