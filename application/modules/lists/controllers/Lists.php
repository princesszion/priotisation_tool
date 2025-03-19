<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lists extends MX_Controller
{


	public  function __construct()
	{
		parent::__construct();

		$this->module = "lists";
		$this->load->model("lists_mdl", 'lists_mdl');
	}
	
	public function get_thematic_areas(){
		$diseases = $this->lists_mdl->get_thematic_areas();
		return $diseases;
	}public function get_diseases_by_theme() {
		$themes = $this->input->post('thematic_ids'); // Receives thematic IDs array from AJAX
	
		if (!empty($themes)) {
			$diseases = $this->lists_mdl->get_diseases_by_theme($themes);
			echo json_encode($diseases);
		} else {
			echo json_encode([]);
		}
	}
	
	public function get_memberstates(){
		return $this->lists_mdl->get_memberstates();

	}


	

}
