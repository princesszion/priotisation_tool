<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Parameters extends MX_Controller
{


	public  function __construct()
	{
		parent::__construct();

		$this->module = "parameters";
		$this->load->model("parameters_mdl", 'params_mdl');
	}
	public function index() {
		$data['title'] ='Parameters';
		$data['module'] = $this->module;
        $data['pivot_data'] = $this->params_mdl->get_pivot_data();
        render('list', $data);
    }
	

}
